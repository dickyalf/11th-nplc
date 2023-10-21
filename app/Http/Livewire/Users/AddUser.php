<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $role;

    public function render()
    {
        return view('livewire.users.add-user');
    }

    public function addUser()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:user,admin'
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => Hash::make($this->password)
        ]);
        session()->flash('success', 'User added successfully.');
        $this->dispatchBrowserEvent('notifyUpdate');
        $this->reset();
    }
}
