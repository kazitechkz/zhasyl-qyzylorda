<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainRequest;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.type.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MainRequest $request)
    {
        Type::add($request->all());
        return redirect(route('type.index'));
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
        $item = Type::findOrFail($id);
        return view('admin.type.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MainRequest $request, string $id)
    {
        $type = Type::findOrFail($id);
        $type->edit($request->all());
        return redirect(route('type.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = Type::findOrFail($id);
        $type->deleteWithRelations($id, 'type_id');
        $type->delete();
        return redirect()->back();
    }
}
