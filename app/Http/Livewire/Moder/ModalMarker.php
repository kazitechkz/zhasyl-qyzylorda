<?php

namespace App\Http\Livewire\Moder;

use App\Models\Breed;
use App\Models\Category;
use App\Models\Event;
use App\Models\Sanitary;
use App\Models\Status;
use App\Models\Type;
use Livewire\Component;

class ModalMarker extends Component
{
    public $search;
    public $events;
    public $sanitaries;
    public $categories;
    public $types;
    public array $breeds = [];
    public $statuses;
    public $geocode;
    public $category_id;
    public $type_id;
    public $breed_id;
    public $sanitary_id;
    public $event_id;
    public $status_id;
    public $height;
    public $diameter;
    public $age;
    public $landing_date;
    public $breedStr = '';
    public array $searchResults = [];
    public bool $showBtn = false;

    public function updatedSearch()
    {
        if ($this->search == '') {
            $this->breeds = [];
            $this->showBtn = false;
        } else {
            $this->breeds = Breed::where('title_ru', 'like', '%'.$this->search.'%')->get()->toArray();
            if (empty($this->breeds)) {
                $this->showBtn = true;
            } else {
                $this->showBtn = false;
            }
        }
    }

    public function setType($id)
    {
        $breed = Breed::findOrFail($id);
        $this->type_id = $breed->type_id;
    }

//    public function updatedBreedStr()
//    {
//        if ($this->breedStr != '')
//        {
//            $this->searchResults = Breed::where('title_ru', 'like', '%'.$this->breedStr.'%')->get()->toArray();
//            if (empty($this->searchResults)) {
//                $this->showBtn = true;
//            } else {
//                $this->showBtn = false;
//            }
//        } else {
//            $this->searchResults = [];
//        }
//    }

    public function addBreed()
    {
        $b = Breed::create([
           'title_ru' => $this->search,
           'coefficient' => 1,
           'status' => env('APP_MODER_ROLE', 2)
        ]);
        $this->breed_id = $b->id;
        $this->updatedSearch();
    }

    protected $rules = [
        'height' => 'required',
        'diameter' => 'required',
        'breed_id' => 'required',
        'type_id' => 'required',
        'landing_date' => 'nullable',
        'status_id' => 'nullable',
        'geocode' => 'required',
        'sanitary_id' => 'required'
//        'age' => 'required'
    ];
    protected $validationAttributes = [
        'event_id' => 'хозяйственное мероприятие',
        'sanitary_id' => 'состояние',
        'type_id' => 'вид насаждения',
        'height' => 'высота',
        'diameter' => 'диаметр',
        'breed_id' => 'порода',
        'geocode' => 'маркер',
        'age' => 'возраст'
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function mount()
    {
//        $this->events = Event::all();
        $this->sanitaries = Sanitary::all();
//        $this->breeds = Breed::all();
//        $this->categories = Category::all();
//        $this->types = Type::all();
//        $this->statuses = Status::all();
    }

    public function submit()
    {
        $validatedData = $this->validate();
    }
    public function render()
    {
        return view('livewire.moder.modal-marker');
    }
}
