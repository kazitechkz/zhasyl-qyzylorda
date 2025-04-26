<?php

namespace App\Http\Livewire\Brigadier\WorkResult;

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
        return view('livewire.brigadier.work-result.create');
    }
}
