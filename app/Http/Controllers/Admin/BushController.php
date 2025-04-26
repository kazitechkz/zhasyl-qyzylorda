<?php

namespace App\Http\Controllers\Admin;

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
        $bushes = Bush::with("area","place","type","breed","sanitary")->paginate(30);
        return view("admin.bush.index",compact("bushes"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $places = Place::with("area","bushes")->get();
        $sanitaries = Sanitary::all();
        $breeds = Breed::all();
        $types = Type::all();
        return view("admin.bush.create",compact("places","sanitaries","breeds","types"));
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
        return redirect()->route("bush.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $places = Place::with(array("area",'bushes' => function($query) use ($id) {
            $query->where('id', '!=', $id);
        }))->get();
        $sanitaries = Sanitary::all();
        $breeds = Breed::all();
        $types = Type::all();
        $bush = Bush::find($id);
        if($bush){
            $bush->load("place");
           return view("admin.bush.edit",compact("bush","places","sanitaries","breeds","types"));
        }
        return redirect()->route("bush.index");

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BushCreateRequest $request, string $id)
    {

        $bush = Bush::find($id);
        if($bush){
            $place = Place::find($request->get("place_id"));
            $input = $request->all();
            $input["area_id"] = $place->area_id;
            $bush->edit($input);
        }
        return redirect()->route("bush.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bush = Bush::find($id);
        if($bush){
           $bush->delete();
        }
        return redirect()->route("bush.index");
    }
}
