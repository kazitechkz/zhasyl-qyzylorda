<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanitaryTypeRequest;
use App\Models\Sanitary;
use App\Models\SanitaryType;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;

class SanitaryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sanitary_types = SanitaryType::with(["sanitary","type"])->get();
        return view("admin.sanitary_type.index",compact("sanitary_types"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sanitaries = Sanitary::all();
        $types = Type::all();
        return view("admin.sanitary_type.create",compact("sanitaries","types"));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SanitaryTypeRequest $request)
    {
        try{
            if(!SanitaryType::where(["type_id"=>$request->get("type_id"),"sanitary_id"=>$request->get("sanitary_id")])->first()){
                $sanitary = SanitaryType::add($request->all());
                $sanitary->uploadFile($request->file("image_url"),"image_url");
                toastr()->success("Успешно создана");
            }
            else{
                toastr()->warning("Такая иконка уже существует");
            }
        }
        catch (Exception $exception){
            toastr()->error($exception->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sanitary_type = SanitaryType::find($id);
        if($sanitary_type){
            $sanitaries = Sanitary::all();
            $types = Type::all();
            return view("admin.sanitary_type.edit",compact("sanitary_type","sanitaries","types"));
        }
        toastr()->warning("Такая иконка не существует");
        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $sanitary_type = SanitaryType::find($id);
            if($sanitary_type){
                $another_sanitary_type = SanitaryType::where(["type_id"=>$request->get("type_id"),"sanitary_id"=>$request->get("sanitary_id")])->first();

                if($another_sanitary_type->id == $sanitary_type->id){
                    $sanitary_type->edit($request->except("image_url"));
                    if($request->file("image_url")){
                        $sanitary_type->uploadFile($request->file("image_url"),"image_url");
                    }
                    toastr()->success("Успешно обновлена");
                }
                else{
                    toastr()->warning("Такая иконка уже существует");
                }
            }
            else{
                toastr()->warning("Такая иконка не существует");
            }
        }
        catch (Exception $exception){
            toastr()->error($exception->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sanitary_type = SanitaryType::find($id);
        if($sanitary_type){
            toastr()->success("Успешно удалено");
            $sanitary_type->delete();
        }
        else{
            toastr()->warning("Такая иконка не существует");
        }
        return redirect()->route("sanitary_type.index");


    }
}
