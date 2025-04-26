<?php

namespace App\Http\Livewire\Brigadier;

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
    public $works = [];

    public function mount()
    {
        $this->getWorks();
    }

    protected function getWorks(){
        $this->works = [];
        $this->works = Work::query()->where(["user_id"=>auth()->id()]);
        if($this->start_at){
            $start_at = Carbon::createFromFormat('H:i d.m.Y', $this->start_at);
            $this->works = $this->works->where("start_at","<=",$start_at);
        }
        if($this->end_at){
            $end_at = Carbon::createFromFormat('H:i d.m.Y', $this->end_at);
            $this->works = $this->works->where("end_at","<=",$end_at);
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
        return view('livewire.brigadier.work-index');
    }
}
