<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfileComponent extends Component
{
    public $user;
    public $old_password, $password, $confirm_password;

    protected $rules = [
        'user.name' => 'required|min:6',
        'user.email' => 'required|email',
        'password' => 'sometimes|nullable|required_with:old_password|min:8',
        'confirm_password' => 'sometimes|nullable|min:8|same:password',
    ];

    public function mount()
    {
        $this->user = Auth::user();
    }
    public function render()
    {
        return view('livewire.auth.profile-component');
    }

    public function updateProfile()
    {
        $this->validate();
        if ($this->password) {
            $this->user->password = bcrypt($this->password);
        }
        $this->user->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Profile Updated Successfully!']);
    }
}
