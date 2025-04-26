<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Breed;
use App\Models\Category;
use App\Models\Event;
use App\Models\Marker;
use App\Models\Place;
use App\Models\Sanitary;
use App\Models\Status;
use App\Models\Type;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class MarkerController extends Controller
{
    public function index(){
        $places = Place::with("area")->get();
        $breeds = Breed::all();
        $categories = Category::all();
        $events = Event::all();
        $sanitaries = Sanitary::all();
        $status = Status::all();
        $types = Type::all();
        return view("admin.marker.index",compact("places","breeds","types","status","sanitaries","events","categories"));
    }

    public function getAllMarkers()
    {
        $markers = Marker::with('place', 'area', 'breed', 'moder')->latest()->paginate(30);
        $users = User::where('role_id', 2)->get();
        return view('admin.marker.all-markers', compact('markers', 'users'));
    }

    public function filterMarkers(Request $request)
    {
        $users = User::where('role_id', 2)->get();
        if ($request['created_at'] != null && $request['user_id'] != 0) {
            $markers = Marker::with('place', 'area', 'breed', 'moder')->where('user_id', $request['user_id'])->whereDate('created_at', Carbon::parse($request['created_at']))->latest()->paginate(30);
        } elseif ($request['user_id'] == 0  && $request['created_at'] != null) {
            $markers = Marker::with('place', 'area', 'breed', 'moder')->whereDate('created_at', Carbon::parse($request['created_at']))->latest()->paginate(30);
        } elseif ($request['user_id'] != 0 && $request['created_at'] == null) {
            $markers = Marker::with('place', 'area', 'breed', 'moder')->where('user_id', $request['user_id'])->latest()->paginate(30);
        } else {
            $markers = Marker::with('place', 'area', 'breed', 'moder')->latest()->paginate(30);
        }
        return view('admin.marker.all-markers', compact('markers', 'users'));
    }

    public function edit(Request $request){
        $query = Marker::query()->where(["place_id" => $request->get("place_id"),"breed_id" => $request->get("breed_id")]);
        $places = Place::with("area")->get();
        $breeds = Breed::all();
        $categories = null;
        $events = null;
        $sanitaries = null;
        $status = null;
        $types = null;
        if($request->get("event_id")){
            $events = Event::all();
            $query = $query->where(["event_id"=>$request->get("event_id")]);
        }
        if($request->get("sanitary_id")){
            $sanitaries = Sanitary::all();
            $query = $query->where(["sanitary_id"=>$request->get("sanitary_id")]);
        }
        if($request->get("status_id")){
            $status = Status::all();
            $query = $query->where(["status_id"=>$request->get("status_id")]);
        }
        if($request->get("type_id")){
            $types = Type::all();
            $query = $query->where(["type_id"=>$request->get("type_id")]);
        }
        if($request->get("category_id")){
            $categories = Category::all();
            $query = $query->where(["category_id"=>$request->get("category_id")]);
        }
        $marker = $query->count();
        $data = $request->all();
        return view("admin.marker.update",compact("places","breeds","types","status","sanitaries","events","categories","marker","data"));
    }

    public function update(Request $request){
        try{
            $query = Marker::where(["place_id" => $request->get("old_place_id"),"breed_id" => $request->get("old_breed_id")]);
            if($request->get("old_event_id")){
                $query = $query->where(["event_id"=>$request->get("old_event_id")]);
            }
            if($request->get("old_sanitary_id")){
                $query = $query->where(["sanitary_id"=>$request->get("old_sanitary_id")]);
            }
            if($request->get("old_status_id")){
                $query = $query->where(["status_id"=>$request->get("old_status_id")]);
            }
            if($request->get("old_type_id")){
                $query = $query->where(["type_id"=>$request->get("old_type_id")]);
            }
            if($request->get("category_id")){
                $query = $query->where(["category_id"=>$request->get("old_category_id")]);
            }
            $marker = $query->update( $request->only(["place_id","breed_id","event_id","sanitary_id","status_id","type_id","category_id"]));
            toastr()->success("Обновлено!");
        }
        catch (Exception $exception){
            toastr()->error($exception->getMessage());
        }
        return redirect()->route("markers");
    }


    public function update_by_place(){
        try{
            ini_set('memory_limit', '-1');
            ini_set('max_execution_time', 600); // 10 minutes
            $data = [];
            $places = Place::all();
            foreach ($places as $place){
                Marker::where(["place_id" => $place->id])->update(["area_id" => $place->area_id]);
            }
            foreach ($places as $place){
                $count = Marker::where(["place_id" => $place->id])->count();
                $data[$place->id] = $count;
            }
            toastr()->success("Обновлено!");
        }
        catch (Exception $exception){
            toastr()->error($exception->getMessage());
        }
        return redirect()->back();

    }
}
