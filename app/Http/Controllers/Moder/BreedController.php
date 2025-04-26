<?php

namespace App\Http\Controllers\Moder;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use App\Models\Type;
use Illuminate\Http\Request;

class BreedController extends Controller
{
    public function __construct()
    {
        $this->middleware('EnsureUserPermission:add breed')->only(['create', 'store','index']);
        $this->middleware('EnsureUserPermission:edit breed')->only(['edit', 'update']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breeds = Breed::latest()->where('status', env('APP_MODER_ROLE',2))->paginate(30);
        return view('moder.breed.index', compact('breeds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('moder.breed.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title_ru' => 'required',
            'coefficient' => 'nullable|numeric'
        ]);
        $data = $request->all();
        if (is_null($request['coefficient'])) {
            $data['coefficient'] = 1;
        }
        $data['status'] = env('APP_MODER_ROLE');
        $breed = Breed::add($data);
        if($request->hasFile("image_url")){
            $breed->uploadBreedImage($request->file("image_url"),"image_url");
        }
        toastr('Success', 'success', 'Успешно создан!');
        return redirect(route('moder-breed.index'));
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
        $breed = Breed::where('status', env('APP_MODER_ROLE',2))->findOrFail($id);
        $types = Type::all();
        return view('moder.breed.edit', compact('breed', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title_ru' => 'required',
            'coefficient' => 'nullable|numeric',
            'type_id' => 'required'
        ]);
        $data = $request->all();
        $data['status'] = env('APP_MODER_ROLE',2);
        $breed = Breed::findOrFail($id);
        $breed->edit($data, 'image_url');
        if($request->hasFile("image_url")){
            $breed->uploadBreedImage($request->file("image_url"),"image_url");
        }
        toastr('Success', 'success', 'Успешно обновлен!');
        return redirect(route('moder-breed.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
