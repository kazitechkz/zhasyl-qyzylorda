<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chef\CreateChefEditRequest;
use App\Http\Requests\Chef\CreateChefUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereIn("role_id",[7,8])->with("role")->paginate(20);
        return view("chef.user.index",compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("chef.user.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateChefUserRequest $request)
    {
        $input = $request->all();
        $input["password"] = bcrypt($request->get("password"));
        $input["status"] = $request->boolean("status");
        $user = User::add($input);
        return redirect()->route("chef-user.index");
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
        $user = User::whereIn("role_id",[7,8])->where(["id"=>$id])->first();
        if($user){
            return view("chef.user.edit",compact("user"));
        }
        return redirect()->route("chef-user.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateChefEditRequest $request, string $id)
    {
        $user = User::whereIn("role_id",[7,8])->where(["id"=>$id])->first();
        if($user){
            $input = $request->all();
            if(strlen($request->get("password")) > 0){
                $input["password"] = bcrypt($request->get("password"));
            }
            else{
                unset($input["password"]);
            }
            $input["status"] = $request->boolean("status");
            $user->edit($input);
        }
        return redirect()->route("chef-user.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::whereIn("role_id",[7,8])->where(["id"=>$id])->first();
        if($user){
            $user->delete();
        }
        return redirect()->route("chef-user.index");
    }
}
