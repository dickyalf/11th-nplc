<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class TableComponent extends Component
{
    public $itemId;
    protected $listeners = ['deleteItem', "reRenderTable"];

    public function render()
    {
        return view('livewire.products.table-component', [
            'products' => Product::get(),
        ]);
    }

    public function confirmDelete($id)
    {
        $this->itemId = $id;

        $this->dispatchBrowserEvent('showConfirmModal');
    }

    public function deleteItem()
    {
        $item = Product::find($this->itemId);

        if ($item) {
            $item->delete();
        }
        session()->flash('success', 'Success delete!');
    }

    public function edit(Product $product){
        $this->dispatchBrowserEvent('update-product', $product);
    }

    public function reRenderTable(){
        $this->render();
    }
}
