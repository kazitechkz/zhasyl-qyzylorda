<?php

namespace App\View\Components;

use App\Models\Area;
use App\Models\Breed;
use App\Models\Category;
use App\Models\Marker;
use App\Models\Sanitary;
use App\Models\Status;
use App\Models\Type;
use Closure;
use Illuminate\Contracts\View\View;
use Livewire\Component;


class SearchInputs extends Component
{
    public $areas;
    public $types;
    public $breeds;
    public $sanitaries;

    public function mount()
    {
        $this->areas = Area::all();
        $this->types = Type::all();
//        $categories = Category::all();
        $this->breeds = Breed::all();
        $this->sanitaries = Sanitary::all();
        //        $statuses = Status::all();
    }
    public function clickTest()
    {
        dd('ttt');
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('livewire.mayor.search-inputs');
    }
}
