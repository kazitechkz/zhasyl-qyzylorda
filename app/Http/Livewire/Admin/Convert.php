<?php

namespace App\Http\Livewire\Admin;

use App\Models\Breed;
use App\Models\Marker;
use App\Models\Type;
use Livewire\Component;

class Convert extends Component
{
    public $types;
    public $type_id;
    public $markers;
    public $data;
    public $loading = false;

    public function mount()
    {
        $this->types = Type::all();
    }

    public function getMarkers($id)
    {
        $this->type_id = $id;
        $this->loading = false;
        if ($id == 0) {
            $this->data = [];
        } else {
            $this->data = Marker::with('type', 'breed')->where('type_id', $id)
                ->select('breed_id', \DB::raw('count(*) as total'))
                ->groupBy('breed_id')
                ->orderBy('total', 'DESC')
                ->get();

        }
//        dd($this->data[2]);
    }

    public function convert()
    {
        $this->loading = true;
        $breeds = Breed::all();
        foreach ($breeds as $breed) {
            Marker::where('breed_id', $breed->id)->update([
                'type_id' => $breed->type_id
            ]);
        }
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.admin.convert');
    }
}
