<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function view($file)
    {
        if (auth()->check() && auth()->user()->role == 'admin') {
            $path = 'media/softfile/' . $file;
            if (Storage::exists($path)) {
                return Storage::download($path, $file);
            }
        }
        return redirect()
            ->back()
            ->with('error', 'Unauthorized access or file not found.');
    }

    public function download($invoice, $product)
    {
        if (auth()->check()) {
            $invoice = auth()
                ->user()
                ->invoices()
                ->where('invoice_number', $invoice)
                ->firstOrFail();
            $product = $invoice
                ->invoiceDetails()
                ->where(['product_id' => $product, 'invoice_id' => $invoice->id])
                ->firstOrFail()->product->softfile;
            //dd($product->file);
            $path = $product->file;
            if (Storage::exists($path)) {
                return Storage::download($path, $invoice->invoice_number . '.pdf');
            }
        }
        abort(404);
    }

    public function guestDownload($invoice, $product, $reference)
    {
        $invoice = Invoice::where([
            'invoice_number' => $invoice,
            'payment_reference' => $reference,
        ])->firstOrFail();
        $product = $invoice
            ->invoiceDetails()
            ->where(['product_id' => $product, 'invoice_id' => $invoice->id])
            ->firstOrFail()->product->softfile;
        $path = $product->file;
        if (Storage::exists($path)) {
            return Storage::download($path, $invoice->invoice_number . '.pdf');
        }
        abort(404);
    }
}
