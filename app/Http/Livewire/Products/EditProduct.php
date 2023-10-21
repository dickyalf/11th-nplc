<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;
    public Product $product;
    public $name, $description, $quantity, $price, $category, $image;

    protected $listeners = ['setProductEdit'];

    public function render()
    {
        return view('livewire.products.edit-product');
    }

    public function setProductEdit(Product $data)
    {
        $this->product = $data;
        $this->description = $data->description;
        $this->category = $data->category;
        $this->name = $data->name;
        $this->quantity = $data->quantity;
        $this->price = $data->price;
    }

    public function editProduct()
    {
        $this->validate([
            'description' => 'required',
            'name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]);
        session()->flash('success', 'Product updated successfully.');
        $this->dispatchBrowserEvent('notifyUpdate');
        $this->reset();
    }
}
