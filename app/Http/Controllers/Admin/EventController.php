<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MainRequest $request)
    {
        Event::add($request->all());
        return redirect(route('event.index'));
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
        $item = Event::findOrFail($id);
        return view('admin.event.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MainRequest $request, string $id)
    {
        $event = Event::findOrFail($id);
        $event->edit($request->all());
        return redirect(route('event.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->deleteWithRelations($id, 'event_id');
        $event->delete();
        return redirect()->back();
    }
}
