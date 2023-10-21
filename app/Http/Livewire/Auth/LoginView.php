<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginView extends Component
{
    public $email,
        $password,
        $remember = false;
    public function render()
    {
        return view('livewire.auth.login-view')
            ->extends('layouts.auth')
            ->section('auth-content');
    }

    public function reset_fields()
    {
        $this->email = '';
        $this->password = '';
        $this->remember = false;
    }

    private function flash_message(string $key, string $value)
    {
        session()->flash($key, $value);
    }

    public function login()
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            if (Auth::user()->role === 'admin') {
                $this->reset_fields();
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
            }
        }
        $this->flash_message('error', 'Email or Password not found!');
    }
}
