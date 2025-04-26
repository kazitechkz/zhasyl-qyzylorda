<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainRequest;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::all();
        return view('admin.status.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.status.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MainRequest $request)
    {
        Status::add($request->all());
        return redirect(route('status.index'));
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
        $item = Status::findOrFail($id);
        return view('admin.status.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MainRequest $request, string $id)
    {
        $status = Status::findOrFail($id);
        $status->edit($request->all());
        return redirect(route('status.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Status::findOrFail($id)->delete();
        return redirect()->back();
    }
}
