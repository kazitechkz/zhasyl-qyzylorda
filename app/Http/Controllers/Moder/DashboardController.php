<?php

namespace App\Http\Controllers\Moder;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Marker;
use App\Models\UserPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Marker::where(["user_id" => auth()->id()])->count();
        $info_day = DB::table('markers')
            ->where("user_id",auth()->id())
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->get();
        $info_month = DB::table('markers')
            ->where("user_id",auth()->id())
            ->select(DB::raw('count(*) as total'),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->groupby('year','month')
            ->get();

        $breed_day = Marker::where(["user_id" => auth()->id()])->select(
            DB::raw('DATE(created_at) as date_created'),
            'breed_id',
            DB::raw('COUNT(*) as count')
        )
            ->groupBy(DB::raw('DATE(created_at)'), 'breed_id')
            ->orderBy(DB::raw('DATE(created_at)'))
            ->orderBy('breed_id')
            ->with("breed")
            ->get();

        $breed_day = $breed_day->groupBy("date_created")->toArray();

        return view('moder.dashboard',compact("total","info_month","info_day","breed_day"));
    }

    public function maps()
    {
//        $areas = Area::with(['places' => function($query){
//            $query->withCount('markers');
//        }])->get();
        $areas = [];
        $places = UserPlace::where('user_id', auth()->id())->with(['place' => function($query){
            $query->with('area')->withCount('markers');
        }])->get();
        foreach ($places as $place) {
            $areas[] = $place->place->area;
        }
        return view('moder.map', compact('places', 'areas'));
    }
    public function places()
    {
        $places = UserPlace::with('place.area')->where('user_id', auth()->id())->paginate(10);
        return view('moder.place', compact('places'));
    }

}
