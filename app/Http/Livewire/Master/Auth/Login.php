<?php

namespace App\Http\Livewire\Master\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email,
        $password,
        $remember = false;

    public function reset_fields()
    {
        $this->email = '';
        $this->password = '';
        $this->remember = false;
    }
    public function render()
    {
        return view('livewire.master.auth.login');
    }

    public function login()
    {
        $this->validate([
            'email' => ['required', 'email', 'min:10'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->reset_fields();
            return redirect()->route('home');
        }
        session()->flash('error', 'Email or Password not found!');
    }
}
