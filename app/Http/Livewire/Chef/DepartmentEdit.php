<?php

namespace App\Http\Livewire\Chef;

use App\Models\Department;
use Livewire\Component;

class DepartmentEdit extends Component
{
    public $department;
    public $title;

    protected $rules = [
        "title"=>"required|max:255",
    ];

    public function mount(Department $department)
    {
        $this->department = $department;
        $this->title = $department->title ?? "";
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.chef.department-edit');
    }
}
