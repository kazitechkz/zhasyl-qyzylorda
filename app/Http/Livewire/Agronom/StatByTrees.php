<?php

namespace App\Http\Livewire\Agronom;

use App\Models\Area;
use App\Models\CategoryPlace;
use App\Models\Marker;
use App\Models\Place;
use App\Models\Sanitary;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatByTrees extends Component
{
    public $areas;
    public $area;
    public $places;
    public $categories;
    public $sanitaries;
    public $area_id;
    public $place_id;
    public $place;
    public $category_id;
    public $sanitary_id;
    public $breeds = [];

    public function mount()
    {
        $this->areas = Area::all();
        $this->sanitaries = Sanitary::all();
        $this->categories = CategoryPlace::all();
    }

    public function render()
    {
        if($this->area_id){
            DB::statement("SET SQL_MODE=''");
            $this->area = Area::find($this->area_id);
            $query = Place::where(["area_id"=>$this->area_id]);
            if($this->category_id){
                $query->where(["category_id"=>$this->category_id]);
            }
            if($this->place_id){
                $this->place = Place::find($this->place_id);
                $this->breeds = [];
                $stats = Marker::where(["place_id"=>$this->place_id])->with("breed")->select('sanitary_id', DB::raw('count(*) as sanitary_total'))->groupBy("sanitary_id")->select('sanitary_id','place_id','breed_id', DB::raw('count(*) as breed_total'))->groupBy("breed_id")->get();
                if($stats){
                    foreach ($stats as $stat){
                        $this->breeds[$stat->sanitary_id][] = $stat;
                    }
                }
            }
            $this->places = $query
                ->with("category")
                ->withCount(array("markers as sanitary_health"=>function($query) {
                    $query->where("sanitary_id",1);
                }))
                ->withCount(array("markers as sanitary_bad"=>function($query) {
                    $query->where("sanitary_id",2);
                }))
                ->withCount(array("markers as sanitary_critic"=>function($query) {
                    $query->where("sanitary_id",3);
                }))
                ->orderBy("sanitary_critic","DESC")
                ->get();
        }
        return view('livewire.agronom.stat-by-trees');
    }
}
