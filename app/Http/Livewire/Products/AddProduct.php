<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use App\Models\Softfile;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduct extends Component
{
    use WithFileUploads;
    public $name, $description, $quantity, $price, $category, $image, $weight, $softfile;
    public function render()
    {
        return view('livewire.products.add-product');
    }

    public function addProduct()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric|min:1',
            'category' => 'required|in:0,1',
            'image' => 'required|image|max:5070',
            'weight' => 'sometimes|nullable|required_if:category,1|numeric',
            'softfile' => 'sometimes|nullable|required_if:category,0|mimes:pdf|max:10240',
        ]);

        $imagePath = $this->image->storePublicly('media/products', 'public');

        $product = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'category' => $this->category,
            'image' => $imagePath,
            'weight' => $this->weight ?? 0,
        ]);
        if ($this->category == 0) {
            $softfilePath = $this->softfile->store('media/softfile');
            $softfile = Softfile::create([
                'product_id' => $product->id,
                'file' => $softfilePath,
            ]);
            $product->softfile()->save($softfile);
        }
        session()->flash('message', 'Product added successfully.');
        $this->dispatchBrowserEvent('notifyUpdate');
        $this->reset();
    }
}
