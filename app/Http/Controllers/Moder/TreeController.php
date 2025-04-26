<?php

namespace App\Http\Controllers\Moder;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarkerRequest;
use App\Models\Breed;
use App\Models\GeoPosition;
use App\Models\Marker;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Yoeunes\Toastr\Facades\Toastr;

class TreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trees = Marker::with('place', 'type')->where('user_id', auth()->id())->paginate(20);
        return view('moder.marker.index', compact('trees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarkerRequest $request)
    {
        $data = $request->all();
        $breed = Breed::find($data['breed_id']);
        if ($breed != null) {
            $data['age'] = round(($data['diameter'] * 0.5) / $breed->coefficient);
            $data['type_id'] = $breed->type_id;
        } else {
            $data['age'] = round($data['diameter'] * 0.5);
        }
        $test = Carbon::now()->format('Y') - $data['age'];
        $data['landing_date'] = Carbon::createFromDate($test)->format('d.m.Y');
        $data['user_id'] = auth()->id();
        foreach (json_decode($request['geocode'][0]) as $datum) {
            $data['geocode'] = json_encode($datum);

            $data['point'] = new Point($datum->lat, $datum->lng);
            Marker::add($data);
        }
        Toastr::success('Дерево было добавлено!', 'Успешно');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tree = Marker::with('place.area', 'type', 'event', 'breed', 'category', 'sanitary', 'status')->findOrFail($id);
        return view('moder.marker.show', compact('tree'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Marker::findOrFail($id)->delete();
        return redirect()->back();
    }
}
