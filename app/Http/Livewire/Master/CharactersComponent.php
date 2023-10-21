<?php

namespace App\Http\Livewire\Master;

use App\Models\Character;
use Livewire\Component;

class CharactersComponent extends Component
{
    public $showing = 4;
    public $perPage = 4;
    public function render()
    {
        $characters = Character::latest()->paginate($this->perPage);
        return view('livewire.master.characters-component', ['characters' => $characters]);
    }
}
