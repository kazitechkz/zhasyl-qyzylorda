<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainRequest;
use App\Models\Marker;
use App\Models\Sanitary;
use Illuminate\Http\Request;

class SanitaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sanitaries = Sanitary::all();
        return view('admin.sanitary.index', compact('sanitaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sanitary.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MainRequest $request)
    {
        $sanitary = Sanitary::add($request->all());
        if($request->hasFile("image_url")){
            $sanitary->uploadFile($request->file("image_url"),"image_url");
        }
        return redirect(route('sanitary.index'));
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
        $item = Sanitary::findOrFail($id);
        return view('admin.sanitary.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MainRequest $request, string $id)
    {
        $sanitary = Sanitary::findOrFail($id);
        $sanitary->edit($request->all());
        if($request->hasFile("image_url")){
            $sanitary->uploadFile($request->file("image_url"),"image_url");
        }
        return redirect(route('sanitary.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sanitary = Sanitary::findOrFail($id);
        $sanitary->deleteWithRelations($id, 'sanitary_id');
        $sanitary->delete();
        return redirect()->back();
    }
}
