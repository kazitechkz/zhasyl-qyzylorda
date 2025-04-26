<?php

namespace App\Http\Livewire\Consumer;

use App\Models\Area;
use App\Models\Breed;
use App\Models\Consumer;
use App\Models\Place;
use App\Models\Sanitary;
use App\Models\Type;
use Livewire\Component;

class SearchInput extends Component
{
    public $areas;
    public $areaId;
    public $types;
    public $breeds;
    public $sanitaries;
    public $places = [];
    public bool $show = false;

    public function mount()
    {
        $areasIds = Consumer::where(["user_id"=>auth()->id()])->pluck("area_id","area_id")->toArray();
        $this->areas = Area::whereIn("id",$areasIds)->get();
        $this->types = Type::all();
        $this->breeds = Breed::all();
        $this->sanitaries = Sanitary::all();
    }

    public function getPlacesByAreaId()
    {
        if ($this->areaId != 0) {
            $this->show = true;
            $this->places = Place::where('area_id', $this->areaId)->get();
        } else {
            $this->show = false;
            $this->places = [];
        }

    }
    public function render()
    {
        return view('livewire.consumer.search-input');
    }
}
