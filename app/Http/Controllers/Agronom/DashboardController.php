<?php

namespace App\Http\Controllers\Agronom;

use App\Exports\MarkerExport;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Breed;
use App\Models\Marker;
use App\Models\Population;
use App\Models\Sanitary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $markerTotal = Marker::count();
        $breeds = DB::table('markers')
            ->select('breed_id', DB::raw('count(*) as total'))
            ->groupBy('breed_id')
            ->orderBy('total', 'DESC')
            ->get();
        $breedTotal = $breeds->pluck("total");
        $breedsT = Breed::whereIn("id", $breeds->pluck("breed_id")->toArray())->pluck("title_ru","id");
        foreach ($breeds as $item) {
            if ($item->breed_id) {
                $dataForBreed[] = [$breedsT[$item->breed_id], $item->total];
            }
        }

        $areas = Area::withCount('markers')->get();
        $sanitaries = Sanitary::withCount('markers')->get();
        foreach ($areas as $value) {
            $dataForArea[] = [$value->title_ru, $value->markers_count];
        }

        foreach ($sanitaries as $value) {
            $dataForSanitary[] = [$value->title_ru , $value->markers_count];
        }
        $populations = Population::with('area')->get();
        return view('agronom.dashboard', compact('dataForBreed', 'dataForArea', 'dataForSanitary', 'markerTotal', 'populations', 'areas'));
    }

    public function statistics()
    {
        $forExp = [];
        $markers = Marker::with('sanitary', 'breed', 'place.area')->paginate(20);

        return view('agronom.statistics', compact('markers', 'forExp'));
    }
    public function statisticsByTree()
    {
        return view('agronom.statistics-by-trees');
    }

    public function statisticsTree()
    {
        return view('agronom.statistics-trees');
    }

    public function search(Request $request)
    {
        $markers = Marker::searchable($request->all())->paginate(20);
        $forExp = $request->all();
        return view('agronom.statistics', compact('markers', 'forExp'));
    }

    public function export(Request $request)
    {
        (new MarkerExport($request->all()))->store('markers.xlsx');
        toastr('Экспорт начался!');
        return back();
    }

    public function marker_edit($id){
        $marker = Marker::with(["area","event","type","breed","sanitary","status","category","place","user"])->firstWhere("id",$id);
        if($marker){
            return view('agronom.marker_show', compact('marker'));
        }
        toastr('Не найдено!');
        return back();
    }
}
