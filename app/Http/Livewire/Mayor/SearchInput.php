<?php

namespace App\Http\Livewire\Mayor;

use App\Models\Area;
use App\Models\Breed;
use App\Models\CategoryPlace;
use App\Models\Place;
use App\Models\Sanitary;
use App\Models\Type;
use Livewire\Component;

class SearchInput extends Component
{
    public $areas;
    public $categoryPlaces;
    public $categoryId;
    public $areaId;
    public $types;
    public $breeds;
    public $sanitaries;
    public $places = [];
    public bool $show = false;

    public function mount()
    {
        $this->areas = Area::all();
        $this->types = Type::all();
        $this->breeds = Breed::all();
        $this->sanitaries = Sanitary::all();
        $this->categoryPlaces = CategoryPlace::all();
    }

    public function getPlacesByAreaId()
    {
        if ($this->areaId != 0) {
            $this->show = true;
            $this->places = Place::where(['area_id' => $this->areaId, 'category_id' => $this->categoryId])->get();
        } else {
            $this->show = false;
            $this->places = [];
        }

    }

    public function render()
    {
        return view('livewire.mayor.search-input');
    }
}
