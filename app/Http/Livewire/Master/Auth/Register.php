<?php

namespace App\Http\Livewire\Master\Auth;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $fullname,
        $email,
        $password,
        $password_confirmation,
        $remember = false;

    public function render()
    {
        return view('livewire.master.auth.register');
    }

    public function register(){
        $this->validate([
            'fullname' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $this->fullname,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => 'user'
        ]);

        if($user){
            session()->flash('success', 'Register Success!');
            return redirect()->route('login');
        }
    }
}
