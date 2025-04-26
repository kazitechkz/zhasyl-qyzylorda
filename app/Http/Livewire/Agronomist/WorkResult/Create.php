<?php

namespace App\Http\Livewire\Agronomist\WorkResult;

use App\Models\Work;
use Livewire\Component;

class Create extends Component
{
    public $work;
    public $status;
    public $comment;

    public function mount(Work $work){
        $this->work = $work;
    }
    public function render()
    {
        return view('livewire.agronomist.work-result.create');
    }
}
