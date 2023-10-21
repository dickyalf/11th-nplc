<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Component;

class TableComponent extends Component
{
    protected $listeners = ['show', 'reRenderTable', 'deleteInvoice'];
    public $deleteInvoice;

    public function render()
    {
        return view('livewire.invoices.table-component', [
            'invoices' => Invoice::all(),
        ]);
    }

    public function reRenderTable(){
        $this->render();
    }

    public function edit(Invoice $inv)
    {
        $this->dispatchBrowserEvent('edit-invoice', $inv);
    }

    public function show(Invoice $inv)
    {
        $this->dispatchBrowserEvent('show-invoice', $inv);
    }

    public function confirmDelete($id){
        $this->deleteInvoice = $id;

        $this->dispatchBrowserEvent('showConfirmModal');
    }

    public function deleteInvoice(){
        $invoice = Invoice::find($this->deleteInvoice);
        $invoice->delete();
        $this->dispatchBrowserEvent('notifyDelete');
    }
}
