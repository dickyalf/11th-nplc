<?php

namespace App\Http\Livewire\Characters;

use App\Models\Character;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditCharacter extends Component
{
    use WithFileUploads;
    public $name, $description, $image;
    public Character $character;

    protected $listeners = ['setCharacterEdit'];
    public function render()
    {
        return view('livewire.characters.edit-character');
    }

    public function setCharacterEdit(Character $character){
        $this->character = $character;
        $this->name = $character->name;
        $this->description = $character->description;
        $this->dispatchBrowserEvent('initEdit', ['description' => $this->description]);
    }

    public function editCharacter(){
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|sometimes|image|max:2048'
        ]);

        if ($this->image){
            Storage::disk('public')->delete($this->character->image);
            $imagePath = $this->image->storePublicly('media/characters', 'public');
            $this->character->update([
                'name' => $this->name,
                'description' => $this->description,
                'image' => $imagePath,
            ]);
        } else{
            $this->character->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);
        }
        session()->flash('success', 'Character updated successfully.');
        $this->dispatchBrowserEvent('notifyUpdate');
    }
}
