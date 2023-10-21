<?php

namespace App\Http\Livewire\Master;

use App\Models\Cart;
use Livewire\Component;

class CartsComponent extends Component
{
    protected $listeners = ['cartAdded' => 'cartAdded'];

    public function render()
    {
        $carts = auth()->check() ? auth()->user()->carts : Cart::where('session_id', session()->getId())->get();
        $totalCart = 0;
        foreach ($carts as $cart) {
            $totalCart += $cart->product->price * $cart->quantity;
        }
        return view('livewire.master.carts-component', ['carts' => $carts, 'totalCart' => $totalCart]);
    }

    public function removeCart($cartId)
    {
        $cart = Cart::findOrFail($cartId);
        $cart->delete();
        $this->dispatchBrowserEvent('message', ['type' => 'success', 'msg' => 'Product removed from cart successfully.']);
    }

    public function cartAdded()
    {
        $this->render();
    }
}
