<?php

namespace App\Http\Livewire\Characters;

use App\Models\Character;
use Livewire\Component;

class TableComponent extends Component
{
    public $characterId;
    protected $listeners = ['deleteCharacter', "reRenderTable"];
    public function render()
    {
        return view('livewire.characters.table-component', [
            'characters' => Character::get(),
        ]);
    }

    public function edit(Character $character){
        $this->dispatchBrowserEvent('update-character', $character);
    }

    public function confirmDelete($id)
    {
        $this->characterId = $id;

        $this->dispatchBrowserEvent('showConfirmModal');
    }

    public function deleteCharacter()
    {
        $item = Character::find($this->characterId);

        if ($item) {
            $item->delete();
        }
        session()->flash('success', 'Success delete!');
    }

    public function reRenderTable(){
        $this->render();
    }
}
