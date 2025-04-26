<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserPresenceChannel;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\GeoPosition;
use App\Models\Marker;
use App\Models\Place;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Matrix\Builder;

class DashboardController extends Controller
{
    public function index()
    {

        $top_ten = DB::table('markers')
            ->select('user_id', DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->orderBy("total","DESC")
            ->take(10)
            ->get();

        $total = $top_ten->pluck("total");
        $user_ids = $top_ten->pluck("user_id");
        $users = User::whereIn("id",$top_ten->pluck("user_id")->toArray())->pluck("name","id");
        return view('admin.dashboard',compact("total","users","user_ids"));
    }

    public function convert()
    {
        return view('admin.convert');
    }

    public function map()
    {
        $areas = Area::with(['places' => function($query){
            $query->withCount('markers');
        }])->get();
        return view('admin.map', compact('areas'));
    }

    public function geo_positions()
    {
        $moders = User::with('geo')->where('role_id', 2)->get();
        return view('admin.geo.index', compact('moders'));
    }

    public function getByGeo($id)
    {
        return view('admin.geo.show', compact("id"));
    }

    public function all_trees(){
        return view("admin.geo.all_trees");
    }



}
