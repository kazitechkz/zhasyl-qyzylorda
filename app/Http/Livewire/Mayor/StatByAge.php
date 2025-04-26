<?php

namespace App\Http\Livewire\Mayor;

use App\Models\Breed;
use App\Models\Marker;
use App\Models\Place;
use App\Models\Sanitary;
use Livewire\Component;
use Livewire\WithPagination;

class StatByAge extends Component
{
    use WithPagination;
    public $area_id;
    public $age;
    public $places;
    public $place_id = 0;
    public $breeds;
    public $breed_id = 0;
    public $sanitaries;
    public $sanitary_id = 0;
    public function mount($area_id, $age): void
    {
        $this->breeds = Breed::all();
        $this->sanitaries = Sanitary::all();
        $this->places = Place::where('area_id', $area_id)->get();
        $this->area_id = $area_id;
        $this->age = $age;
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $query = Marker::with('breed', 'place', 'sanitary', 'area')->where('area_id', $this->area_id);
        if ($this->place_id != 0) {
            $query = $query->where('place_id', $this->place_id);
        }
        if ($this->breed_id != 0) {
            $query = $query->where('breed_id', $this->breed_id);
        }
        if ($this->sanitary_id != 0) {
            $query = $query->where('sanitary_id', $this->sanitary_id);
        }
        switch ($this->age) {
            case 1:
                $markers = $query->where('age', '<', 5)->paginate(20);
                break;
            case 2:
                $markers = $query->whereBetween('age', [5,15])->paginate(20);
                break;
            case 3:
                $markers = $query->whereBetween('age', [15,30])->paginate(20);
                break;
            case 4:
                $markers = $query->whereBetween('age', [30,50])->paginate(20);
                break;
            case 5:
                $markers = $query->whereBetween('age', [50,100])->paginate(20);
                break;
            case 6:
                $markers = $query->where('age', '>', 100)->paginate(20);
                break;
            default:
                $markers = $query->paginate(20);
                break;
        }
        return view('livewire.mayor.stat-by-age', [
            'markers' => $markers
        ]);
    }
}
