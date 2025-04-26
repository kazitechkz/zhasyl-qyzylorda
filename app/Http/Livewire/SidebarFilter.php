<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Breed;
use App\Models\Category;
use App\Models\Event;
use App\Models\Marker;
use App\Models\Place;
use App\Models\Sanitary;
use App\Models\Status;
use App\Models\Type;
use Exception;
use Livewire\Component;
use MatanYadaev\EloquentSpatial\Objects\Point;

class SidebarFilter extends Component
{
    public $areas;
    public $places;
    public $activeMarker;
    public $selectedAreas = [];
    //load filters
    public $categories = [];
    public $sanitaries = [];
    public $events = [];
    public $status = [];
    public $types = [];
    public $breeds = [];
    //load filters
    public $selectedPlaces = [];
    protected $listeners = [
        'areaChanged' => 'areaChangedEvent',
        "placeChange"=>"placeChangedEvent",
        "loadMarker"=>"getMarkerById",
        "removeMarker"=>"removeMarkerById",
        "changeMarkerGeo"=>"changeMarkerPosition"
        ];
    public function mount()
    {
        $this->areas = Area::all();
        $this->categories = Category::all();
        $this->events = Event::all();
        $this->sanitaries = Sanitary::all();
        $this->status = Status::all();
        $this->types = Type::all();
        $this->breeds = Breed::all();
        $this->loadPlaces();
    }
    public function areaChangedEvent($areaId)
    {
        if (in_array($areaId, $this->selectedAreas)) {
            // Remove the element from the array
            array_splice($this->selectedAreas, array_search($areaId, $this->selectedAreas), 1);
        } else {
            // Add the element to the array
            array_push($this->selectedAreas,$areaId);
        }
        $this->loadPlaces();
    }
    public function placeChangedEvent($placeId)
    {
        if (in_array($placeId, $this->selectedPlaces)) {
            // Remove the element from the array
            array_splice($this->selectedPlaces, array_search($placeId, $this->selectedPlaces), 1);
        } else {
            // Add the element to the array
            array_push($this->selectedPlaces,$placeId);
        }
        return $this->places;
    }
    public function loadPlaces(){
        if(count($this->selectedAreas) > 0){
            $this->places = Place::whereIn("area_id",$this->selectedAreas)->get();
        }
        else{
            $this->places = [];
        }
    }
    public function getPlaces(){
        return $this->selectedAreas;
    }

    public function getMarkerById($id){
        $this->activeMarker = Marker::where(["id"=>$id])->with(["area","breed","place","sanitary","event","status","category","type"])->first();
    }

    public function removeMarkerById($id){
        try {
            Marker::destroy($id);
            toastr()->success("Маркер успешно удалено");
            $this->activeMarker = null;
        }
        catch (Exception $e) {
            toastr()->warning("Что-то пошло не так");
        }

    }
    public function changeMarkerPosition($id,$latLng){
        $marker = Marker::where(["id"=>$id])->first();
        if($marker){
            $marker->geocode = $latLng;
            $latLng = json_decode($latLng);
            $marker->point = new Point($latLng->lat, $latLng->lng);
            $marker->save();
        }
    }
    public function render()
    {
        return view('livewire.sidebar-filter');
    }
}
