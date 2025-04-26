<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function getAllPlace(){
        return Place::all();
    }

    public function getAreasPlace(Request $request){

        if($request->get("ids")){
            return Place::whereIn("area_id",explode(",", $request->get("ids")))->get();
        }
        return [];

    }
}
