<?php

namespace App\Http\Livewire\Chef;

use App\Models\Role;
use Livewire\Component;

class UserCreate extends Component
{
    public $roles;
    public $name;
    public $email;
    public $password;
    public $role_id;
    public $status = true;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'role_id' => 'required',
        "status" => "",
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function mount()
    {
        $this->roles = Role::whereIn("id",[7,8])->get();
        $this->name = old("name") ?? "";
        $this->role_id = old("role_id");
        $this->email = old("email") ?? "";
        $this->status = old("status") ?? false;
    }


    public function render()
    {
        return view('livewire.chef.user-create');
    }
}
