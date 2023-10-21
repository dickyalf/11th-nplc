<?php

namespace App\Http\Livewire\Master;

use App\Models\Cart;
use Livewire\Component;

class Carts extends Component
{
    public $carts;
    public $totalCart = 0;
    public $provinces = [];
    public $citys = [];
    //Model
    public $delivery_fee;
    public $province = -1,
        $city = -1;

    protected $rules = [
        'carts.*.quantity' => 'required|numeric|min:1',
    ];

    public function mount()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.rajaongkir.com/starter/province',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => ['key: ' . env('RAJAONGKIR_API_KEY')],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if (!$err) {
            $json = json_decode($response, true);
            if ($json['rajaongkir']['status']['code'] == 200) {
                $this->provinces = $json['rajaongkir']['results'];
            } else {
                $this->dispatchBrowserEvent('message', ['type' => 'error', 'msg' => $json['rajaongkir']['status']['description']]);
            }
        }
        $this->carts = auth()->check() ? auth()->user()->carts : Cart::where('session_id', session()->getId())->get();
        foreach ($this->carts as $cart) {
            $this->totalCart += $cart->product->price * $cart->quantity;
        }
    }
    public function render()
    {
        $this->emit('cartAdded');
        return view('livewire.master.carts');
    }

    public function removeCart($cartId)
    {
        $cart = Cart::findOrFail($cartId);
        $cart->delete();
        $this->dispatchBrowserEvent('message', ['type' => 'success', 'msg' => 'Product removed from cart successfully.']);
        $this->emit('cartAdded');
    }

    public function min($idx)
    {
        if ($this->carts[$idx]->quantity > 1) {
            $this->carts[$idx]->quantity--;
        } else {
            $this->dispatchBrowserEvent('message', ['type' => 'error', 'msg' => 'Quantity is less than 1.']);
        }
        $this->updateCartQuantity($idx);
    }

    public function plus($idx)
    {
        if ($this->carts[$idx]->quantity < $this->carts[$idx]->product->quantity) {
            $this->carts[$idx]->quantity++;
        } else {
            $this->dispatchBrowserEvent('message', ['type' => 'error', 'msg' => 'Quantity is more than stock.']);
        }
        $this->updateCartQuantity($idx);
    }
    public function updateCartQuantity($idx)
    {
        $this->validate();
        $this->carts[$idx]->save();
    }

    public function handleProvinceChange()
    {
        if ($this->province != -1) {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.rajaongkir.com/starter/city?province=' . $this->province,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => ['key: ' . env('RAJAONGKIR_API_KEY')],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if (!$err) {
                $json = json_decode($response, true);
                if ($json['rajaongkir']['status']['code'] == 200) {
                    $this->citys = $json['rajaongkir']['results'];
                } else {
                    $this->dispatchBrowserEvent('message', ['type' => 'error', 'msg' => $json['rajaongkir']['status']['description']]);
                }
            }
        }
    }

    public function calculate()
    {
        if (count($this->carts) == 0) {
            $this->dispatchBrowserEvent('message', ['type' => 'error', 'msg' => 'Cart is empty.']);
            return;
        } elseif ($this->province != -1 && $this->city != -1) {
            $totalWeight = 0;
            foreach ($this->carts as $cart) {
                $totalWeight += $cart->product->weight * $cart->quantity;
            }
            $data = [
                'origin' => env('RAJAONGKIR_ORIGIN'),
                'destination' => $this->city,
                'weight' => $totalWeight,
                'courier' => 'jne',
            ];
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.rajaongkir.com/starter/cost',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => http_build_query($data),
                CURLOPT_HTTPHEADER => ['content-type: application/x-www-form-urlencoded', 'key: ' . env('RAJAONGKIR_API_KEY')],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if (!$err) {
                $json = json_decode($response, true);
                if ($json['rajaongkir']['status']['code'] == 200) {
                    $costs = $json['rajaongkir']['results'][0]['costs'];
                    if (count($costs) > 0) {
                        $this->delivery_fee = $costs[0]['cost'][0];
                    }
                } else {
                    $this->dispatchBrowserEvent('message', ['type' => 'error', 'msg' => $json['rajaongkir']['status']['description']]);
                }
            }
        } else {
            $this->dispatchBrowserEvent('message', ['type' => 'error', 'msg' => 'Please select province and city.']);
        }
    }
}
