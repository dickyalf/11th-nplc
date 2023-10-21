<?php

namespace App\Http\Livewire\Master;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditAccountComponent extends Component
{
    public $user;

    public $old_password, $password, $password_confirmation;   

    protected $rules = [
        'user.name' => 'required|min:6',
        'password' => 'sometimes|nullable|required_with:old_password|min:8',
        'password_confirmation' => 'sometimes|nullable|min:8|same:password'
    ];

    public function mount()
    {
        $this->user = Auth::user();
    }
    public function render()
    {
        return view('livewire.master.edit-account-component');
    }

    public function editAccount(){
        $this->validate();
        if($this->password){
            $this->user->password = bcrypt($this->password);
        }
        $this->user->save();
        $this->dispatchBrowserEvent('message', ['type' => 'success', 'msg' => 'Account updated successfully']);
    }
}
