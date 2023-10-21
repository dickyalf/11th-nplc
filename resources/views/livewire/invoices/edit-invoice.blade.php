<div>
    <form wire:submit.prevent='editInvoice' class="px-4">
        <div class="form-floating mb-4">
            <input type="text" class="form-control" id="user" placeholder="user"
                value="{{ $invoice != null && $invoice->user != null ? $invoice->user->name : 'Guest' }}" disabled>
            <label class="form-label" for="user">User</label>
        </div>
        <div class="form-floating mb-4">
            <input type="text" class="form-control" id="inv_number" placeholder="inv_number"
                value="{{ $invoice != null ? $invoice->invoice_number : '' }}" disabled>
            <label class="form-label" for="inv_number">Invoice Number</label>
        </div>
        <div class="form-floating mb-4">
            <input type="text" class="form-control" id="payment" placeholder="payment"
                value="{{ $invoice != null ? (isset($invoice->paymentMethod) ? $invoice->paymentMethod->name : "Unknown"): '' }}" disabled>
            <label class="form-label" for="payment">Payment</label>
        </div>

        <div class="form-floating mb-4">
            <select class="form-select @error('invoice.payment_status') is-invalid @enderror" id="payment_status"
                aria-label="Payment Status" wire:model="invoice.payment_status">
                <option value=''>Select an option</option>
                <option value="0">Pending</option>
                <option value="1">Success</option>
                <option value="2">Failed</option>
            </select>
            <label class="form-label" for="example-select-floating">Payment Status</label>
            @error('invoice.payment_status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        @if ($invoice != null && $invoice->payment_status == 1)
            <div class="form-floating mb-4">
                <input type="text" class="form-control @error('invoice.payment_reference') is-invalid @enderror"
                    id="payment_reference" name="payment_reference" placeholder="Payment Reference"
                    wire:model='invoice.payment_reference'>
                <label class="form-label" for="payment_reference">Payment Reference</label>
                @error('invoice.payment_reference')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endif


        @if ($invoice != null && $invoice->payment_status == 1)
            <div class="form-floating mb-4">
                <select class="form-select @error('invoice.delivery_status') is-invalid @enderror" id="delivery_status"
                    aria-label="Payment Status" wire:model="invoice.delivery_status">
                    <option value=''>Select an option</option>
                    <option value="0">Waiting</option>
                    <option value="1">On Delivery</option>
                    <option value="2">Delivered</option>
                    <option value="3">Failed</option>
                </select>
                <label class="form-label" for="example-select-floating">Delivery Status</label>
                @error('invoice.delivery_status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endif

        @if ($invoice != null && ($invoice->delivery_status == 1 || $invoice->delivery_status == 2) && $invoice->payment_status == 1)
            <div class="form-floating mb-4">
                <input type="text" class="form-control @error('invoice.resi_number') is-invalid @enderror"
                    id="resi_number" name="resi_number" placeholder="Resi Number"
                    wire:model='invoice.resi_number'>
                <label class="form-label" for="resi_number">Resi Number</label>
                @error('invoice.resi_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endif




        <div>
            <button type="submit" class="btn btn-alt-primary mb-4">
                Edit
            </button>
        </div>
    </form>
</div>
