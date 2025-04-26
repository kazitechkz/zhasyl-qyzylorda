<?php

namespace App\Http\Livewire\Home;

use App\Models\Area;
use App\Models\Breed;
use App\Models\CategoryPlace;
use App\Models\Marker;
use App\Models\Place;
use Livewire\Component;

class Heatmap extends Component
{
    public $point;
    public $areas;
    public $area_id;
    public $loading = false;

    public function mount(){
        $this->areas = Area::all();
        //$this->point = null;
    }
    protected $listeners = ['setMarkers',"getMarkers"];
    public function changeArea(){
        if($this->area_id){
            $this->areas = Area::where(["id"=>$this->area_id])->get();
        }
        $this->emit("getMarkers",$this->point);
    }


    public function getMarkers(){
        $points = null;
        if($this->area_id){
            $placeIDS = Place::where(["area_id"=>$this->area_id])->pluck("id","id")->toArray();
            $this->loading = true;
            $points = Marker::whereIn("place_id",$placeIDS)->select("point")->get()->toArray();
        }
        $this->loading = false;
        $this->emit("setMarkers",$points);

    }

    public function setMarkers($points){
        $this->point = $points;
    }

    public function render()
    {
        return view('livewire.home.heatmap');
    }
}
