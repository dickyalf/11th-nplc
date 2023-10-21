<?php

namespace App\Http\Livewire\Slider;

use App\Models\Slider;
use Livewire\Component;

class EditSlider extends Component
{
    public Slider $slider;
    public $cta;
    protected $listeners = ['setSliderEdit'];

    protected $rules = [
        'slider.title' => 'required',
        'slider.subtitle' => 'required',
        'slider.action_title' => 'sometimes|nullable|required_if:cta,1',
        'slider.action_url' => 'sometimes|nullable|required_if:cta,1',
    ];


    public function render()
    {
        return view('livewire.slider.edit-slider');
    }
    public function setSliderEdit(Slider $data){
        $this->slider = $data;
        $this->cta = ($data->action_title && $data->action_url) ? 1 : 0;
    }

    public function editSlider(){
        $this->validate();
        if($this->cta == 0){
            $this->slider->action_title = null;
            $this->slider->action_url = null;
        }
        $this->slider->save();
        session()->flash('success', 'Slider updated successfully.');
        $this->dispatchBrowserEvent('notifyUpdate');
        $this->reset();
    }
}
