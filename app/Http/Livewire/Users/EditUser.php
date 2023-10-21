<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public User $user;
    public $name;
    public $email;
    public $password;
    public $role;
    protected $listeners = ['setUserEdit'];

    public function render()
    {
        return view('livewire.users.edit-user');
    }

    public function setUserEdit(User $data){
        $this->user = $data;
        $this->name = $data->name;
        $this->email = $data->email;
        $this->role = $data->role;
    }

    public function editUser(){
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'role' => 'required|in:user,admin',
            'password' => 'nullable|min:8'
        ]);

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => $this->password ? bcrypt($this->password) : $this->user->password,
        ]);
        session()->flash('success', 'User updated successfully.');
        $this->dispatchBrowserEvent('notifyUpdate');
        $this->reset();
    }
}
