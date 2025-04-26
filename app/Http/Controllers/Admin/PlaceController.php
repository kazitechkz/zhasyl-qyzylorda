<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Breed;
use App\Models\Category;
use App\Models\CategoryPlace;
use App\Models\Event;
use App\Models\Marker;
use App\Models\Place;
use App\Models\Sanitary;
use App\Models\Status;
use App\Models\Type;
use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::with("area")->latest()->paginate(20);
        return view("admin.place.index",compact("places"));
    }

    public function addPlace($id = null)
    {
        $area = Area::find($id);
        $areas = Area::with("places")->get();
        $cats = CategoryPlace::all();
        return view('admin.place.create', compact('area',"areas", 'cats'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::all();
        $places = Place::all();
        $cats = CategoryPlace::all();
        return view("admin.place.create",compact("areas","places", 'cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title_ru' => 'required',
            'bg_color' => 'required',
            'geocode' => 'required',
            'area_id'=>'required',
            'category_id' => 'required'
        ]);
        Place::add($request->all());
        return redirect(route('place.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd("i am show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $place = Place::findOrFail($id);
        $area = Area::where(["id"=>$place->area_id])->first();
        $places = Place::where(["area_id"=>$area->id])->whereNot("id",$place->id)->get();
        $cats = CategoryPlace::all();
        return view("admin.place.edit",compact("area","place","places", 'cats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title_ru' => 'required',
            'bg_color' => 'required',
            'geocode' => 'required',
            'category_id' => 'required'
        ]);
        $place = Place::findOrFail($id);
        $place->edit($request->except(["area_id"]));
        return redirect(route('place.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $place = Place::findOrFail($id);
        $place->delete();
        return redirect()->back();
    }


    public function changeMarker($id){
        $marker = Marker::find($id);
        if($marker){
            $types = Type::all();
            $events = Event::all();
            $sanitaries = Sanitary::all();
            $categories = Category::all();
            $breeds = Breed::all();
            $status = Status::all();
            return view("admin.marker.edit",compact("marker","types","events","sanitaries","categories",
            "breeds","status"
            ));
        }
        return redirect('/404');
    }

    public function updateMarker(Request $request,string $id){
        $marker = Marker::find($id);
        if($marker){
            $request->validate([
                "height"=>"gte:1",
                "age"=>"gte:1",
                "diameter"=>"gte:1",
            ]);
            $data = $request->all();
            if ($request['geocode'] != null) {
                $geo = json_decode($request['geocode']);
                $data['geocode'] = json_encode($geo);
                $data['point'] = new Point($geo->lat, $geo->lng);
            } else {
                unset($data['geocode']);
            }
            $marker->edit($data);
            toastr()->success('Данные успешно обновлены!');
            return redirect()->back();
        }
        toastr()->warning('Посадка не найдена!');
        return redirect('/404');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $places = Place::query()
            ->with('area')
            ->where('title_ru', 'LIKE', '%' . $query . '%')
            ->orWhere('title_kz', 'LIKE','%' . $query . '%')
            ->paginate(20);
        return view ('admin.place.index', compact('places'));
    }

    public function deleteByPlace($id){
        $place = Place::find($id);
        $breeds = Breed::with("type")->get();
        if($place){
            return view("admin.marker.delete_by_place",compact("place","breeds"));
        }
        toastr()->warning('Посадка не найдена!');
        return redirect('/404');
    }
    public function deleteByPlaceStats(Request $request,$id){
        $request->validate(["geocode"=>"required"]);
        try{
            $breeds_ids = $request->get("breeds_id");
            $polygon = Polygon::fromJson($request->get("geocode"));
            if($breeds_ids){
                $markersCount = Marker::whereContains($polygon, "point")->where(["place_id"=>$id])->whereIn("breed_id",$request->get("breeds_id"))->count();
                Marker::whereContains($polygon, "point")->where(["place_id"=>$id])->whereIn("breed_id",$request->get("breeds_id"))->delete();
            }
            else{
                $markersCount = Marker::whereContains($polygon, "point")->where(["place_id"=>$id])->count();
                Marker::whereContains($polygon, "point")->where(["place_id"=>$id])->delete();
            }
            toastr()->success("Удалено насаждений: ". $markersCount,"Success");
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
        }
        return redirect()->back();
    }


    public function changeByPlace($id){
        $place = Place::find($id);
        if($place){
            $places = Place::where("id","!=",$place->id)->with("area")->get();
            return view("admin.marker.change-markers-place",compact("place","places"));
        }
        toastr()->warning('Посадка не найдена!');
        return redirect('/404');
    }

    public function changeByPlaceState(Request $request,$id){
        $request->validate(["geocode"=>"required","to_place"=>"required|exists:places,id"]);
        try{
            $polygon = Polygon::fromJson($request->get("geocode"));
            $query = Marker::whereContains($polygon, "point")->where(["place_id"=>$id]);
            $markersCount = $query->count();
            $to_place = Place::find($request->get("to_place"));
            $area = Area::find($to_place->area_id);
            $query->update(["place_id" => $to_place->id,"area_id"=>$area->id]);
            toastr()->success("Перемещено насаждений: ". $markersCount,"Success");
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
        }
        return redirect()->back();
    }
}
