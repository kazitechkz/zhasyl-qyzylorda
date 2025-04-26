<?php

namespace App\Http\Livewire\Chef;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class UserEdit extends Component
{
    public $user;
    public $roles;
    public $name;
    public $email;
    public $password;
    public $role_id;
    public $status = true;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'sometimes|nullable|min:4|max:16',
        'role_id' => 'required',
        "status" => "",
    ];
    public function mount(User $user)
    {
        $this->user = $user;
        $this->roles = Role::whereIn("id",[7,8])->get();
        $this->name = $user->name ?? "";
        $this->role_id =  $user->role_id ?? null;
        $this->email = $user->email ?? "";
        $this->status = $user->status ?? false;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view('livewire.chef.user-edit');
    }
}
