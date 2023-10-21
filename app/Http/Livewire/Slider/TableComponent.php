<?php

namespace App\Http\Livewire\Slider;

use App\Models\Slider;
use Livewire\Component;

class TableComponent extends Component
{
    public $slideId;
    protected $listeners = ['deleteSlider', 'reRenderTable'];
    public function render()
    {
        return view('livewire.slider.table-component', [
            'slider' => Slider::get(),
        ]);
    }

    public function confirmDelete($id)
    {
        $this->slideId = $id;

        $this->dispatchBrowserEvent('showConfirmModal');
    }

    public function deleteSlider()
    {
        $item = Slider::find($this->slideId);

        if ($item) {
            $item->delete();
        }
        session()->flash('success', 'Success delete!');
    }

    public function edit(Slider $product)
    {
        $this->dispatchBrowserEvent('update-slider', $product);
    }

    public function reRenderTable()
    {
        $this->render();
    }
}
