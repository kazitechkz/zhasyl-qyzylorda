<?php

namespace App\Http\Livewire\Chef;

use App\Models\Department;
use App\Models\DepartmentUser;
use App\Models\User;
use Livewire\Component;

class WorkCreate extends Component
{
    public $departments;
    public $department_id;
    public $users;
    public $user_id;
    public $title;
    public $description;
    public $point;
    public $start_at;
    public $end_at;


    public function mount()
    {
        $this->departments = Department::where(["chief_id" => auth()->id()])->get();
        $this->title = old("title") ?? "";
        $this->description = old("description") ?? "";
        $this->start_at = old("start_at") ?? "";
        $this->end_at = old("end_at") ?? "";
    }

    public function changeDepartment(){
        $departmentIDS = DepartmentUser::where(["department_id" => $this->department_id])->pluck("user_id")->toArray();
        $this->users = User::whereIn("id",$departmentIDS)->with("role")->get();
    }

    public function render()
    {
        return view('livewire.chef.work-create');
    }
}
