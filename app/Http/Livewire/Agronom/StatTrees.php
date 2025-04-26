<?php

namespace App\Http\Livewire\Agronom;

use App\Models\Area;
use App\Models\Bush;
use App\Models\CategoryPlace;
use App\Models\Marker;
use App\Models\Place;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatTrees extends Component
{
    public $areas;
    public $area;
    public $area_id;

    public $places;
    public $place_id;
    public $place;

    public $categories;
    public $category_id;

    public $breeds = [];

    public $areaStat = false;
    public $placeStat = false;
    public $types = [];
    public $bushes = [];
    public function mount()
    {
        $this->areas = Area::all();
        $this->categories = CategoryPlace::all();
    }


    public function render()
    {
        $this->changePlace();
        $this->getBreedStats();
        return view('livewire.agronom.stat-trees');
    }


    public function changePlace(){
        if($this->area_id){
            $this->area = Area::find($this->area_id);
            $query = Place::where(["area_id"=>$this->area_id]);
            if($this->category_id){
                $query->where(["category_id"=>$this->category_id]);
            }
            if($this->place_id){
                $this->place = Place::find($this->place_id);
            }
            $this->places = $query->get();
        }
    }

    public function getBreedStats(){
        DB::statement("SET SQL_MODE=''");
        $stats = [];
        $statsBushes = [];
        $this->areaStat = true;
        $this->placeStat = false;
        if($this->area_id && !$this->place_id){
            $stats =  Marker::where(["area_id"=>$this->area_id])
                ->with(["breed","sanitary",'area','place'])
                ->select('area_id','sanitary_id','breed_id', DB::raw('count(*) as breed_total'))
                ->groupBy(['breed_id','sanitary_id'])
                ->get()->toArray();
            $this->types = Marker::where(["area_id"=>$this->area_id])
                ->with(["type"])
                ->select('type_id', DB::raw('count(*) as breed_total'))
                ->groupBy(["type_id"])->get()->toArray();
            $statsBushes = Bush::where(["area_id"=>$this->area_id])
                ->with(["breed","sanitary",'area','place'])
                ->select('area_id','place_id','sanitary_id','breed_id', DB::raw('sum(length) as length_total'))
                ->groupBy(['breed_id',"sanitary_id"])
                ->get()->toArray();

        }
        elseif ($this->area_id && $this->place_id){
            $this->areaStat = false;
            $this->placeStat = true;
            $stats =  Marker::where(["place_id"=>$this->place_id])
                ->with(["breed","sanitary",'area','place'])
                ->select('area_id','place_id','sanitary_id','breed_id', DB::raw('count(*) as breed_total'))
                ->groupBy(['breed_id','sanitary_id'])
                ->get()->toArray();
            $this->types = Marker::where(["place_id"=>$this->place_id])
                ->with(["type"])
                ->select('type_id', DB::raw('count(*) as breed_total'))
                ->groupBy(["type_id"])->get()->toArray();
            $statsBushes = Bush::where(["place_id"=>$this->place_id])
                ->with(["breed","sanitary",'area','place'])
                ->select('area_id','place_id','sanitary_id','breed_id', DB::raw('sum(length) as length_total'))
                ->groupBy(['breed_id',"sanitary_id"])
                ->get()->toArray();
        }
        $this->getStat($stats);
        $this->getStatBushes($statsBushes);

    }


    protected function getStat($stats){
        $this->breeds = [];
        foreach ($stats as $stat){
            if(key_exists($stat["breed_id"],$this->breeds)){
                $this->breeds[$stat["breed_id"]]["breed_total"] += $stat["breed_total"];
                $this->breeds[$stat["breed_id"]]["sanitaries"][$stat["sanitary_id"]] = [
                    "breed_total"=>$stat["breed_total"],
                    "sanitary"=>$stat["sanitary"]
                ];
            }
            else{
                $this->breeds[$stat["breed_id"]] = [
                    "breed_id"=>$stat["breed_id"],
                    "breed_total" => $stat["breed_total"],
                    "place"=>$stat["place"],
                    "breed"=>$stat["breed"],
                    "area"=>$stat["area"],
                    "sanitaries"=>[
                        $stat["sanitary_id"]=>[
                            "breed_total"=>$stat["breed_total"],
                            "sanitary"=>$stat["sanitary"]
                        ]
                    ]
                ];
            }
        }
    }

    protected function getStatBushes($statsBushes){
        $this->bushes = [];
        foreach ($statsBushes as $stat){
            if(key_exists($stat["breed_id"],$this->bushes)){
                $this->bushes[$stat["breed_id"]]["length_total"] += $stat["length_total"];
                $this->bushes[$stat["breed_id"]]["sanitaries"][$stat["sanitary_id"]] = [
                    "length_total"=>$stat["length_total"],
                    "sanitary"=>$stat["sanitary"]
                ];
            }
            else{
                $this->bushes[$stat["breed_id"]] = [
                    "breed_id"=>$stat["breed_id"],
                    "length_total" => $stat["length_total"],
                    "place"=>$stat["place"],
                    "breed"=>$stat["breed"],
                    "area"=>$stat["area"],
                    "sanitaries"=>[
                        $stat["sanitary_id"]=>[
                            "length_total"=>$stat["length_total"],
                            "sanitary"=>$stat["sanitary"]
                        ]
                    ]
                ];
            }
        }
    }

}
