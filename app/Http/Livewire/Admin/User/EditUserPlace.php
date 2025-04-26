<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Area;
use App\Models\Consumer;
use App\Models\User;
use Illuminate\Validation\Rules\RequiredIf;
use Livewire\Component;

class EditUserPlace extends Component
{
    public User $user;
    public $name;
    public $email;
    public $password;
    public $status;

    public $areas;
    public $area_id;
    public $is_consumer = false;
    public $consumer_area;
    protected function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' => 'sometimes|nullable',
            "status" => "",
            "area_id" => new RequiredIf($this->is_consumer,"==",true),
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function mount($user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->status = $user->status;
        //Adding Consumer
        if($user->role_id == env('APP_CONSUMER_ROLE', 5)){
            $this->is_consumer = true;
            $this->areas = Area::all();
            $this->consumer_area = Consumer::where(["user_id"=>$user->id])->first();
            if($this->consumer_area){
                $this->area_id = $this->consumer_area->area_id;
            }

        }
    }

    public function submit()
    {
        $validatedData = $this->validate();
        if ($validatedData['password'] != null)
        {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            $validatedData['password'] = $this->user->password;
        }
        $this->user->edit($validatedData);
        if($this->is_consumer){
           if($this->consumer_area){
               $this->consumer_area->edit(["area_id"=>$this->area_id]);
           }
           else{
               Consumer::add(["area_id"=>$this->area_id,"user_id"=>$this->user->id]);
           }
        }
        return redirect(route('user.index'));
    }
    public function render()
    {
        return view('livewire.admin.user.edit-user-place');
    }
}
