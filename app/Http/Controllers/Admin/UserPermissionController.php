<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function getUserPermission($id){
        if($user = User::where(["id"=>$id,"role_id"=>env("APP_MODER_ROLE",2)])->with("permission")->first()){
            return view("admin.user.user_permission",compact("user"));
        }
        else{
            toastr()->warning("Пользователь не найден");
            return redirect()->back();
        }
    }


    public function giveUserPermission(Request $request){
        $this->validate($request,["permission"=>"required","user_id"=>"required|exists:users,id"]);
        if($user = User::where(["id"=>$request->get("user_id"),"role_id"=>env("APP_MODER_ROLE",2)])->first()){
            Permission::add($request->only(["user_id","permission"]));
            toastr()->success("Успешно добавлено");
        }
        else{
            toastr()->warning("Пользователь не найден");
        }
        return redirect()->back();
    }

    public function deleteUserPermission($id,$user_id){
        if($permission = Permission::find($id)){
            $permission->delete();
            toastr()->success("Разрешение удалено");
        }
        else{
            toastr()->warning("Разрешение не найдено");
        }
        return redirect()->route("get-user-permission",["id"=>$user_id]);
    }
}
