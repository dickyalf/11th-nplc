<?php

namespace App\Http\Livewire\Master;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class InvoicesComponent extends Component
{
    public $invoices = [];

    protected $listeners = ['invoiceFromCookies'];

    public function render()
    {
        $cookie = false;
        if (Auth::check()) {
            $this->invoices = Invoice::where('user_id', Auth::user()->id)->get();
        } else {
            $cookie = true;
        }
        return view('livewire.master.invoices-component', ['loadCookies' => $cookie]);
    }

    public function invoiceFromCookies($rawData)
    {
        $cookies = explode(';', $rawData);

        foreach ($cookies as $cookie) {
            [$name, $value] = explode('=', $cookie, 2);
            $name = trim($name);
            $value = trim($value);
            $cookies[$name] = $value;
        }
        if (isset($cookies['invoices'])) {
            $inv = $cookies['invoices'];
            $data = json_decode($inv, true);
            foreach ($data as $invoice) {
                $this->invoices[] = Invoice::where([
                    'payment_reference' => $invoice['payment_reference'],
                    'invoice_number' => $invoice['invoice_number'],
                ])->first();
            }
            //$this->render();
        }
    }

    public function pay($id)
    {
        $inv = Invoice::findOrFail($id);
        $this->dispatchBrowserEvent('payment', ['reference' => $inv->payment_reference]);
    }
}
