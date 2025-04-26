<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::all();
        return view('admin.area.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $initialAreas = Area::all();
        return view('admin.area.create', compact('initialAreas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'title_ru' => 'required',
           'bg_color' => 'required',
           'geocode' => 'required'
        ]);

        Area::add($request->all());
        return redirect(route('area.index'));
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
        $areas = Area::where("id","!=",$id)->get();
        $area = Area::findOrFail($id);
        return view('admin.area.edit', compact('area',"areas"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title_ru' => 'required',
            'bg_color' => 'required',
            'geocode' => 'required'
        ]);
        $area = Area::findOrFail($id);
        $area->edit($request->all());
        return redirect(route('area.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $area = Area::findOrFail($id);
        $area->delete();
        return redirect()->back();
    }
}
