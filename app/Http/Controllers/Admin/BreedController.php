<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainRequest;
use App\Models\Breed;
use App\Models\Type;
use Illuminate\Http\Request;

class BreedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breeds = Breed::latest()->paginate(30);
        return view('admin.breed.index', compact('breeds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.breed.create', compact('types'));
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
        $data['status'] = env('APP_ADMIN_ROLE',1);
        $breed = Breed::add($data);
        if($request->hasFile("image_url")){
            $breed->uploadBreedImage($request->file("image_url"),"image_url");
        }
        toastr('Success', 'success', 'Успешно создан!');
        return redirect(route('breed.index'));
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
        $breed = Breed::findOrFail($id);
        $types = Type::all();
        return view('admin.breed.edit', compact('breed', 'types'));
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
        $data['status'] = env('APP_ADMIN_ROLE',1);
        $breed = Breed::findOrFail($id);
        $breed->edit($data, 'image_url');
        if($request->hasFile("image_url")){
            $breed->uploadBreedImage($request->file("image_url"),"image_url");
        }
        toastr('Success', 'success', 'Успешно обновлен!');
        return redirect(route('breed.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $breed = Breed::findOrFail($id);
        $breed->removeBreedImage('image_url');
        $breed->deleteWithRelations($id, 'breed_id');
        $breed->delete();
        toastr('Success', 'error', 'Успешно удален!');
        return redirect()->back();
    }
}
