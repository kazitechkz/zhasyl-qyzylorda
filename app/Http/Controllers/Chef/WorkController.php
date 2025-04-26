<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chef\CreateWorkRequest;
use App\Http\Requests\Chef\EditWorkRequest;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use MatanYadaev\EloquentSpatial\Objects\Point;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("chef.work.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("chef.work.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateWorkRequest $request)
    {
        $input = $request->all();
        $input["start_at"] = Carbon::createFromFormat('H:i d.m.Y', $input["start_at"]);
        $input["end_at"] = Carbon::createFromFormat('H:i d.m.Y', $input["end_at"]);
        $input["point"] = Point::fromJson($input["point"]);
        $input["chief_id"] = auth()->id();
        $work = Work::add($input);
        return redirect()->route("chef-work.index");
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
        $work = Work::where(["chief_id" => auth()->id(),"id"=>$id])->first();
        if($work){
            return view("chef.work.edit",compact("work"));
        }
        return redirect()->route("chef-work.index");

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditWorkRequest $request, string $id)
    {
        $work = Work::where(["chief_id" => auth()->id(),"id"=>$id])->first();
        if($work){
            $input = $request->all();
            $input["start_at"] = Carbon::createFromFormat('H:i d.m.Y', $input["start_at"]);
            $input["end_at"] = Carbon::createFromFormat('H:i d.m.Y', $input["end_at"]);
            $input["point"] = Point::fromJson($input["point"]);
            $input["chief_id"] = auth()->id();
            $work->edit($input);
        }
        return redirect()->route("chef-work.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $work = Work::where(["chief_id" => auth()->id(),"id"=>$id])->first();
        if($work){
            $work->delete();
        }
        return redirect()->route("chef-work.index");
    }
}
