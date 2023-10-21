<?php

namespace App\Http\Livewire\Master;

use App\Models\Cart;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use TheSeer\Tokenizer\Exception;

class CheckoutComponent extends Component
{
    public $carts;
    public $totalCart = 0;
    public $provinces = [];
    public $citys = [];

    //model
    public $destination_details;
    public $delivery_courier;
    public $delivery_fee;
    public $province = -1,
        $city = -1;

    public $fullname = '',
        $email = '',
        $phone = '',
        $address = '',
        $zipcode = '';

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
        if (auth()->check()) {
            $this->fullname = auth()->user()->name;
            $this->email = auth()->user()->email;
        }
        $this->carts = auth()->check() ? auth()->user()->carts : Cart::where('session_id', session()->getId())->get();
        foreach ($this->carts as $cart) {
            $this->totalCart += $cart->product->price * $cart->quantity;
        }
    }
    public function render()
    {
        return view('livewire.master.checkout-component');
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

    public function handleCourierChange()
    {
        if ($this->province != -1 && $this->city != -1 && $this->delivery_courier != '') {
            $totalWeight = 0;
            foreach ($this->carts as $cart) {
                $totalWeight += $cart->product->weight * $cart->quantity;
            }

            if ($totalWeight > 0) {
                $curl = curl_init();
                $data = [
                    'origin' => env('RAJAONGKIR_ORIGIN'),
                    'destination' => $this->city,
                    'weight' => $totalWeight,
                    'courier' => $this->delivery_courier,
                ];
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'https://api.rajaongkir.com/starter/cost',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => http_build_query($data),
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
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
                        $this->destination_details = $json['rajaongkir']['destination_details'];
                    } else {
                        $this->dispatchBrowserEvent('message', ['type' => 'error', 'msg' => $json['rajaongkir']['status']['description']]);
                    }
                }
            } else {
                $this->delivery_fee = 0;
            }
        } else {
            $this->dispatchBrowserEvent('message', ['type' => 'error', 'msg' => 'Please select province and city']);
        }
    }

    public function checkout()
    {
        if (count($this->carts) == 0) {
            $this->dispatchBrowserEvent('message', ['type' => 'error', 'msg' => 'Shopping cart is empty']);
            return;
        }
        $totalCart = 0;
        foreach ($this->carts as $cart) {
            $totalCart += $cart->product->price * $cart->quantity;
        }

        $this->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'zipcode' => 'required|numeric',
            'province' => 'required',
            'city' => 'required',
            'delivery_courier' => 'required',
            'delivery_fee' => 'required',
            'destination_details' => 'required',
        ]);

        $inv = 'INV-' . date('YmdHis') . '-' . rand(100, 999);

        //curl to payment gateway duitku https://api-sandbox.duitku.com/api/merchant/createInvoice
        $duitkuConfig = new \Duitku\Config(env('DUITKU_KEY'), env('DUITKU_MERCHANT_CODE'));
        $duitkuConfig->setSandboxMode(true);
        // set sanitizer (default : true)
        $duitkuConfig->setSanitizedMode(false);
        // set log parameter (default : true)
        $duitkuConfig->setDuitkuLogs(false);

        $paymentAmount = $totalCart + ($this->delivery_fee != null ? $this->delivery_fee['value'] : 0); // Amount
        $email = $this->email; // your customer email
        $phoneNumber = $this->phone; // your customer phone number (optional)
        $merchantOrderId = $inv; // from merchant, unique
        $customerVaName = $this->fullname; // display name on bank confirmation display
        $callbackUrl = env('APP_URL') . '/api/payment/callback'; // url for callback;
        $returnUrl = env('APP_URL') . '/invoices'; // url for redirect
        $expiryPeriod = 30; // set expired time in minutes
        $address = [
            'firstName' => $this->fullname,
            'address' => '(' . $this->fullname . ' ' . $this->phone . ' ' . $this->email . ') ' . $this->address . ' ' . $this->zipcode . ' ' . $this->destination_details['city_name']. ' ' . $this->destination_details['province'],
            'city' => $this->destination_details['city_name'],
            'postalCode' => $this->zipcode,
            'phone' => $phoneNumber,
        ];

        $customerDetail = [
            'firstName' => $this->fullname,
            'lastName' => 'surname',
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'billingAddress' => $address,
        ];

        $itemDetails = [];
        foreach ($this->carts as $cart) {
            $itemDetails[] = [
                'name' => $cart->product->name,
                'price' => $cart->product->price * $cart->quantity,
                'quantity' => $cart->quantity,
            ];
        }

        $itemDetails[] = [
            'name' => 'Delivery Fee',
            'price' => $this->delivery_fee != null ? $this->delivery_fee['value'] : 0,
            'quantity' => 1,
        ];

        $params = [
            'paymentAmount' => $paymentAmount,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => 'Payment for Order No. ' . $merchantOrderId,
            'customerVaName' => $customerVaName,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'itemDetails' => $itemDetails,
            'customerDetail' => $customerDetail,
            'callbackUrl' => $callbackUrl,
            'returnUrl' => $returnUrl,
            'expiryPeriod' => $expiryPeriod,
        ];
        try {
            $responseDuitkuPop = \Duitku\Pop::createInvoice($params, $duitkuConfig);
            $json = json_decode($responseDuitkuPop, true);
            if ($json['statusCode'] == '0000') {
                DB::transaction(function () use ($inv, $json, $totalCart) {
                    $delivery_address = '(' . $this->fullname . ' ' . $this->phone . ' ' . $this->email . ') ' . $this->address . ' ' . $this->zipcode . ' ' . $this->destination_details['city_name'] . ' ' . $this->destination_details['province'];
                    $invoice = Invoice::create([
                        'user_id' => auth()->check() ? auth()->id() : null,
                        'address' => $this->address,
                        'invoice_number' => $inv,
                        'payment_method_id' => null,
                        'payment_due_date' => now()
                            ->addHour()
                            ->format('Y-m-d H:i:s'),
                        'payment_reference' => $json['reference'],
                        'delivery_address' => $delivery_address,
                        'delivery_courier' => $this->delivery_courier,
                        'price' => $totalCart,
                        'delivery_fee' => $this->delivery_fee != null ? $this->delivery_fee['value'] : 0,
                    ]);

                    foreach ($this->carts as $cart) {
                        $invoice->invoiceDetails()->create([
                            'product_id' => $cart->product_id,
                            'price' => $cart->product->price,
                            'quantity' => $cart->quantity,
                            'sub_total' => $cart->product->price * $cart->quantity,
                        ]);
                    }

                    if (Auth::check()) {
                        $userId = Auth::id();
                        Cart::where('user_id', $userId)->delete();
                    } else {
                        $sessionId = session()->getId();
                        Cart::where('session_id', $sessionId)->delete();
                    }
                });
                $this->dispatchBrowserEvent('message', ['type' => 'success', 'msg' => 'Success create invoice']);
                $this->dispatchBrowserEvent('payment', ['reference' => $json['reference'], 'url' => $json['paymentUrl']]);
                $masterData = [
                    'payment_reference' => $json['reference'],
                    'invoice_number' => $inv,
                ];
                $this->dispatchBrowserEvent('save', [
                    'rawData' => json_encode($masterData),
                    'data' => $masterData,
                ]);
            } else {
                $this->dispatchBrowserEvent('message', ['type' => 'error', 'msg' => $json['response_desc']]);
            }
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('message', ['type' => 'error', 'msg' => $e->getMessage()]);
        }
    }
}
