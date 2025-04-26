<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Area;
use App\Models\Consumer;
use App\Models\Place;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPlace as AdminUserPlace;
use Illuminate\Validation\Rules\RequiredIf;
use Livewire\Component;

class CreateUserPlace extends Component
{
    public $search;
    public $places;
    public $roles;
    public $name;
    public $email;
    public $password;
    public $role_id = 1;
    public $status = true;
    public bool $isShow = false;
    public bool $isShowConsumer = false;
    public $checkedPlaces = [];

    public $areas;
    public $area_id;

    public $consumer_role_id;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'role_id' => 'required',
        "status" => "",
    ];

    public function toggle()
    {

        if ($this->role_id == env('APP_MODER_ROLE', 2)) {
            $this->isShow = true;
            $this->isShowConsumer = false;
        }
        elseif ($this->role_id == env('APP_CONSUMER_ROLE', 5)){
            $this->areas = Area::all();
            $this->isShowConsumer = true;
        }
        else {
            $this->isShow = false;
            $this->isShowConsumer = false;
        }
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function mount()
    {
        $this->roles = Role::all();
    }
    public function updatedSearch()
    {
        if ($this->search == '') {
            $this->places = [];
        } else {
            $this->places = Place::where('title_ru', 'like', '%'.$this->search.'%')->get();
        }
    }

    public function submit()
    {
        $validatedData = $this->validate();
        $validatedData['password'] = bcrypt($validatedData['password']);
        if (!empty($this->checkedPlaces)) {
            $user = User::add($validatedData);
            foreach ($this->checkedPlaces as $checkedPlace) {
                AdminUserPlace::create([
                   'user_id' => $user->id,
                    'place_id' => $checkedPlace
                ]);
            }
        } else {
            $user = User::add($validatedData);
        }

        if($this->isShowConsumer){
            Consumer::add(["area_id"=>$this->area_id,"user_id"=>$user->id]);
        }
        return redirect(route('user.index'));
    }
    public function render()
    {
        return view('livewire.admin.user.create-user-place');
    }
}
