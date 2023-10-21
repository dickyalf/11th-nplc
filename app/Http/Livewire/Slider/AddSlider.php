<?php

namespace App\Http\Livewire\Slider;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddSlider extends Component
{
    use WithFileUploads;
    public $title, $subtitle, $image, $cta = 0, $cta_title, $cta_url;
    public function render()
    {
        return view('livewire.slider.add-slider');
    }

    public function addSlider(){
        $this->validate(
            [
                'title' => 'required',
                'subtitle' => 'required',
                'image' => 'required|image|max:3070',
                'cta_title' => 'sometimes|nullable|required_if:cta,1',
                'cta_url' => 'sometimes|nullable|required_if:cta,1',
            ]
        );

        $imagePath = $this->image->storePublicly('media/slider', 'public');
        
        Slider::create([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'image' => $imagePath,
            'action_title' => $this->cta_title ?? null,
            'action_url' => $this->cta_url ?? null,
        ]);
        session()->flash('message', 'Product added successfully.');
        $this->dispatchBrowserEvent('notifyUpdate');
        $this->reset();
    }
    
}
