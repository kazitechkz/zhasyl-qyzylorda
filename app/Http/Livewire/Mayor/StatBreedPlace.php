<?php

namespace App\Http\Livewire\Mayor;

use App\Models\Area;
use App\Models\Breed;
use App\Models\CategoryPlace;
use App\Models\Marker;
use App\Models\Place;
use App\Models\Sanitary;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatBreedPlace extends Component
{
    public $breed_id;
    public $area_id;
    public $category_id;

    public $areas;
    public $categoryPlaces;
    public $breeds;
    public $places;
    public $count = 0;

    public function mount()
    {
        $this->areas = Area::all();
        $this->categoryPlaces = CategoryPlace::all();
        $this->breeds = Breed::with(["type"])->get();
    }
    public function render()
    {
        //disable ONLY_FULL_GROUP_BY
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        //Your SQL goes here - The one throwing the error (:
        if($this->area_id && $this->breed_id){
            $condition = ["area_id"=>$this->area_id,"breed_id"=>$this->breed_id];
            $query = Marker::where($condition)->with(["breed","place.area","place.category"]);
            $this->count = Marker::where($condition)->count();
            if($this->category_id){
                $category_id = $this->category_id;
                $query= Marker::where($condition)
                    ->whereHas("place",function ($query) use($category_id){
                        $query->where(["category_id"=>$category_id]);
                    })->with(["breed","place.area","place.category"]);
                $this->count = Marker::where($condition)->whereHas("place",function ($query) use($category_id){
                    $query->where(["category_id"=>$category_id]);
                })->count();
            }
            $this->places = $query
                ->select("place_id",'breed_id', DB::raw('count(*) as breed_total'))
                ->orderBy("breed_total","desc")
                ->groupBy(["place_id"])->get();


        }
        //re-enable ONLY_FULL_GROUP_BY
        DB::statement("SET sql_mode=(SELECT CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY'));");


        return view('livewire.mayor.stat-breed-place');
    }
}
