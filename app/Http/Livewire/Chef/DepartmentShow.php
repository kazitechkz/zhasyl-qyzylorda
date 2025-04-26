<?php

namespace App\Http\Livewire\Chef;

use App\Models\Department;
use App\Models\DepartmentUser;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class DepartmentShow extends Component
{
    public $department;
    public $role_id;
    public $free_users;
    public $department_users;
    public $roles;

    public function mount(Department $department)
    {
        $this->department = $department;
        $this->getUsers();
        $this->roles = Role::whereIn("id",[7,8])->get();
    }

    public function changeRole(){
        $roleIDS = [7,8];
        if($this->role_id){
            $roleIDS = [$this->role_id];
        }
        $userIDS = DepartmentUser::where(["department_id" => $this->department->id])->pluck("user_id")->toArray();
        $this->free_users = User::whereNotIn("id",$userIDS)->whereIn("role_id",$roleIDS)->get();
    }

    public function addUserToDepartment($userId){
        if(!DepartmentUser::where(["user_id" => $userId,"department_id" => $this->department->id])->first()){
            DepartmentUser::add(["user_id" => $userId,"department_id" => $this->department->id]);
            $this->getUsers();
        }
    }

    public function deleteUserFromDepartment($userId){
        if($departmentUser = DepartmentUser::where(["user_id" => $userId,"department_id" => $this->department->id])->first()){
            $departmentUser->delete();
            $this->getUsers();
        }
    }

    protected function getUsers(){
        $userIDS = DepartmentUser::where(["department_id" => $this->department->id])->pluck("user_id")->toArray();
        $this->department_users = User::whereIn("id",$userIDS)->with("role")->get();
        $this->free_users = User::whereNotIn("id",$userIDS)->whereIn("role_id",[7,8])->get();
    }

    public function render()
    {
        return view('livewire.chef.department-show');
    }
}
