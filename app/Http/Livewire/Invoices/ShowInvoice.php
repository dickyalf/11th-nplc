<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Livewire\Component;

class ShowInvoice extends Component
{
    public Invoice $invoice;
    public InvoiceDetail $invoiceDetail;
    public $test;
    protected $listeners = ['setShowInvoice'];
    public function render()
    {
        return view('livewire.invoices.show-invoice');
    }

    public function setShowInvoice(Invoice $invoice){
        $this->invoice = Invoice::find($invoice->id);
    }
}
