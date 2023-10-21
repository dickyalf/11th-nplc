<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class RegisterView extends Component
{
    public function render()
    {
        return view('livewire.auth.register-view')
            ->extends('layouts.auth')
            ->section('auth-content');
    }
}
