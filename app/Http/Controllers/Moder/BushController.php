<?php

namespace App\Http\Controllers\Moder;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bush\BushCreateRequest;
use App\Models\Breed;
use App\Models\Bush;
use App\Models\Place;
use App\Models\Sanitary;
use App\Models\Type;
use Illuminate\Http\Request;

class BushController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bushes = Bush::with("area","place","type","breed","sanitary")->where("user_id",auth()->id())->paginate(30);
        return view("moder.bush.index",compact("bushes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($place_id)
    {
        $places = Place::with("area","bushes")->where("id",$place_id)->get();
        $sanitaries = Sanitary::all();
        $breeds = Breed::all();
        $types = Type::all();
        return view("moder.bush.create",compact("places","sanitaries","breeds","types"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BushCreateRequest $request)
    {
        $place = Place::find($request->get("place_id"));
        $input = $request->all();
        $input["area_id"] = $place->area_id;
        $input["user_id"] = auth()->id();
        Bush::add($input);
        return redirect()->route("moder-bush-index");
    }


}
