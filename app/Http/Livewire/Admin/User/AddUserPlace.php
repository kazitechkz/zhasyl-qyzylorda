<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Area;
use App\Models\Place;
use App\Models\User;
use App\Models\UserPlace;
use Livewire\Component;
use Livewire\WithPagination;

class AddUserPlace extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public User $user;
    public $search;
    public $places;
    public $areas;
    public $areaId = 0;
    public $links;
    public bool $show = false;
    public $userPlaces;

    public function mount($user): void
    {
        $this->userPlaces = $user->user_places;
        $this->areas = Area::all();
    }

    public function getPlacesByAreaId(): void
    {
        if ($this->areaId != 0) {
            $this->show = true;
        } else {
            $this->show = false;
        }
        $this->gotoPage(1);
    }

    public function updatedSearch(): void
    {
        $this->gotoPage(1);
//        if ($this->search == '') {
//            $this->places = [];
//        } else {
//            $this->places = Place::with('markers')->where('title_ru', 'like', '%'.$this->search.'%')->get();
//        }
    }

    public function addPlace($place_id): void
    {
        UserPlace::updateOrCreate([
           'user_id' => $this->user->id,
            'place_id' => $place_id
        ]);
        $this->renderPlaces();
    }
    public function deletePlace($id)
    {
        UserPlace::destroy($id);
        $this->renderPlaces();
    }

    public function renderPlaces(): void
    {
        $this->userPlaces = UserPlace::with('place')->where('user_id', $this->user->id)->get();
    }
    public function submit()
    {
        return redirect(route('user.index'));
    }
    public function render()
    {
        if ($this->areaId == 0) {
            $placesWithMarkers = Place::withCount('markers')->orderBy('markers_count', 'asc')->paginate(15);
        } else {
            if ($this->search == '') {
                $placesWithMarkers = Place::withCount('markers')
                    ->orderBy('markers_count', 'asc')
                    ->where('area_id', $this->areaId)
                    ->paginate(15);
            } else {
                $placesWithMarkers = Place::withCount('markers')
                    ->orderBy('markers_count', 'asc')
                    ->where('area_id', $this->areaId)
                    ->where('title_ru', 'like', '%'.$this->search.'%')
                    ->paginate(15)->appends('search', $this->search);
            }
        }
        return view('livewire.admin.user.add-user-place', ['placesWithMarkers' => $placesWithMarkers]);
    }
}
