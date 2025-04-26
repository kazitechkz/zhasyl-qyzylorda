<?php

namespace App\Http\Livewire\Chef;

use App\Models\Department;
use App\Models\DepartmentUser;
use App\Models\User;
use App\Models\Work;
use Illuminate\Support\Carbon;
use Livewire\Component;

class WorkIndex extends Component
{
    public $start_at;
    public $end_at;
    public $departments;
    public $department_id;
    public $users;
    public $user_id;
    public $works = [];

    public function mount()
    {
        $this->departments = Department::where(["chief_id" => auth()->id()])->get();
    }
    public function changeDepartment(){
        $departmentIDS = DepartmentUser::where(["department_id" => $this->department_id])->pluck("user_id")->toArray();
        $this->users = User::whereIn("id",$departmentIDS)->with("role")->get();
        $this->getWorks();
    }

    protected function getWorks(){
        $this->works = [];
        $this->works = Work::query();
        if($this->start_at){
            $start_at = Carbon::createFromFormat('H:i d.m.Y', $this->start_at);
            $this->works = $this->works->where("start_at",">=",$start_at);
        }
        if($this->end_at){
            $end_at = Carbon::createFromFormat('H:i d.m.Y', $this->end_at);
            $this->works = $this->works->where("end_at","<=",$end_at);
        }
        if($this->department_id){
            $this->works = $this->works->where(["department_id"=>$this->department_id]);
        }
        if($this->user_id){
            $this->works = $this->works->where(["user_id"=>$this->user_id]);
        }
        $this->works = $this->works->with(["user","chief","department"])->get();
    }
    public function changeToStart(){
        $this->getWorks();
    }
    public function changeToEnd(){
        $this->getWorks();
    }
    public function render()
    {
        $this->getWorks();
        return view('livewire.chef.work-index');
    }
}
