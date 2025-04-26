<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chef\CreateChefDepartmentRequest;
use App\Http\Requests\Chef\EditChefDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::where(['chief_id' => auth()->id()])->with(["chief"])->withCount(["users","works"])->paginate(20);
        return view("chef.department.index",compact("departments"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("chef.department.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateChefDepartmentRequest $request)
    {
        $input = $request->all();
        $input["chief_id"] = auth()->id();
        $departments = Department::add($input);
        return redirect()->route("chef-department.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::where(["chief_id" => auth()->id(),"id"=>$id])->first();
        if($department){
            return view("chef.department.show",compact("department"));
        }
        return redirect()->route("chef-department.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::where(["chief_id" => auth()->id(),"id"=>$id])->first();
        if($department){
            return view("chef.department.edit",compact("department"));
        }
        return redirect()->route("chef-department.index");

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditChefDepartmentRequest $request, string $id)
    {
        $department = Department::where(["chief_id" => auth()->id(),"id"=>$id])->first();
        if($department){
            $department->edit($request->all());
        }
        return redirect()->route("chef-department.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::where(["chief_id" => auth()->id(),"id"=>$id])->first();
        if($department){
            $department->delete();
        }
        return redirect()->route("chef-department.index");
    }
}
