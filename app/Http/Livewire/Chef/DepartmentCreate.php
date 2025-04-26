<?php

namespace App\Http\Livewire\Chef;

use App\Models\Role;
use Livewire\Component;

class DepartmentCreate extends Component
{
    public $title;
    public $chief_id;

    protected $rules = [
        "title"=>"required|max:255",
    ];

    public function mount()
    {
        $this->title = old("title") ?? "";
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.chef.department-create');
    }
}
