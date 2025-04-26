<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use App\Models\Category;
use App\Models\Event;
use App\Models\Sanitary;
use App\Models\SanitaryType;
use App\Models\Status;
use App\Models\Type;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function getAllSystemData(){
        return [
            "breed"=>Breed::all(),
            "category"=>Category::all(),
            "event"=>Event::all(),
            "sanitary"=>Sanitary::all(),
            "status"=>Status::all(),
            "type"=>Type::all(),
            "sanitary_type"=>SanitaryType::all()
        ];
    }
}
