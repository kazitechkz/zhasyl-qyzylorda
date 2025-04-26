<?php

namespace App\Http\Livewire\Chef;

use App\Models\Department;
use App\Models\DepartmentUser;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Livewire\Component;

class WorkEdit extends Component
{
    public $work;
    public $departments;
    public $department_id;
    public $users;
    public $user_id;
    public $title;
    public $description;
    public $point;
    public $start_at;
    public $end_at;


    public function mount(Work $work)
    {
        $this->work = $work;
        $this->departments = Department::where(["chief_id" => auth()->id()])->get();
        $this->department_id = $work->department_id;
        $departmentIDS = DepartmentUser::where(["department_id" => $this->department_id])->pluck("user_id")->toArray();
        $this->users = User::whereIn("id",$departmentIDS)->with("role")->get();
        $this->title = $work->title;
        $this->description = $work->description;
        $this->start_at = $work->start_at->format('H:i d.m.Y');
        $this->end_at = $work->end_at->format('H:i d.m.Y');
    }

    public function changeDepartment(){
        $departmentIDS = DepartmentUser::where(["department_id" => $this->department_id])->pluck("user_id")->toArray();
        $this->users = User::whereIn("id",$departmentIDS)->with("role")->get();
    }
    public function render()
    {
        return view('livewire.chef.work-edit');
    }
}
