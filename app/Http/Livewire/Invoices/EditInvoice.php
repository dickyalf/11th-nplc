<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Component;

class EditInvoice extends Component
{
    public Invoice $invoice;
    protected $listeners = ['setEditInvoice'];
    protected $rules = [
        'invoice.payment_status' => 'required',
        'invoice.payment_reference' => 'sometimes|nullable|required_if:invoice.payment_status,1',
        'invoice.delivery_status' => 'sometimes|nullable|required_if:invoice.payment_status,1',
        'invoice.resi_number' => 'sometimes|nullable|required_if:invoice.delivery_status,1|required_if:invoice.payment_status,1'
    ];
    public function render()
    {
        return view('livewire.invoices.edit-invoice');
    }

    public function setEditInvoice(Invoice $invoice)
    {
        $this->invoice = Invoice::find($invoice->id);
    }

    public function editInvoice(){
        $this->validate();
        $this->invoice->save();
        $this->dispatchBrowserEvent('notifyUpdate');
    }
}
