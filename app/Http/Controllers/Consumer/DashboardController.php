<?php

namespace App\Http\Controllers\Consumer;

use App\Exports\MarkerExport;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Breed;
use App\Models\Consumer;
use App\Models\Marker;
use App\Models\Population;
use App\Models\Sanitary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class DashboardController extends Controller
{



    public function index()
    {
        $areasIds = Consumer::where(["user_id"=>auth()->id()])->pluck("area_id","area_id")->toArray();
        $markerTotal = Marker::count();
        $breeds = Marker::
            whereIn("area_id",$areasIds)
            ->select('breed_id', DB::raw('count(*) as total'))
            ->groupBy('breed_id')
            ->orderBy('total', 'DESC')
            ->get();
        $breedTotal = $breeds->pluck("total") ?? 0;
        $breedsT = Breed::whereIn("id", $breeds->pluck("breed_id")->toArray())->pluck("title_ru","id");
        $dataForBreed = [];
        foreach ($breeds as $item) {
            if ($item->breed_id) {
                $dataForBreed[] = [$breedsT[$item->breed_id], $item->total];
            }
        }
        $areas = Area::whereIn("id",$areasIds)->withCount('markers')->get();
        $sanitaries = Sanitary::withCount('markers')->get();
        $dataForArea = [];
        foreach ($areas as $value) {
            $dataForArea[] = [$value->title_ru, $value->markers_count];
        }

        foreach ($sanitaries as $value) {
            $dataForSanitary[] = [$value->title_ru , $value->markers_count];
        }
        $populations = Population::whereIn("area_id",$areasIds)->with('area')->get();
        return view('consumer.dashboard', compact('dataForBreed', 'dataForArea', 'dataForSanitary', 'markerTotal', 'populations', 'areas',"areasIds"));
    }

    public function statistics()
    {
        $areasIds = Consumer::where(["user_id"=>auth()->id()])->pluck("area_id","area_id")->toArray();
        $forExp = [];
        $markers = Marker::whereIn("area_id",$areasIds)->with('sanitary', 'breed', 'place.area')->paginate(20);
        return view('consumer.statistics', compact('markers', 'forExp'));
    }
    public function statisticsByTree()
    {
        return view('consumer.statistics-by-trees');
    }
    public function statisticsTree()
    {
        return view('consumer.statistics-trees');
    }

    public function search(Request $request)
    {
        $areasIds = Consumer::where(["user_id"=>auth()->id()])->pluck("area_id","area_id")->toArray();
        $markers = Marker::searchable($request->all())->whereIn("area_id",$areasIds)->paginate(20);
        $forExp = $request->all();
        return view('consumer.statistics', compact('markers', 'forExp',"areasIds"));
    }

    public function export(Request $request)
    {
        (new MarkerExport($request->all()))->store('markers.xlsx');
        toastr('Экспорт начался!');
        return back();
    }

    public function marker_edit($id){
        $areasIds = Consumer::where(["user_id"=>auth()->id()])->pluck("area_id","area_id")->toArray();

        $marker = Marker::whereIn("area_id",$areasIds)->with(["area","event","type","breed","sanitary","status","category","place","user"])->firstWhere("id",$id);
        if($marker){
            return view('consumer.marker_show', compact('marker'));
        }
        toastr('Не найдено!');
        return back();
    }
}
