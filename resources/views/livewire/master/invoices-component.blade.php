@push('js')
    <script>
        @if ($loadCookies)
            $(document).ready(function() {
                Livewire.emit('invoiceFromCookies', document.cookie);
            });
        @endif
    </script>
@endpush

<div class="card">
    <div class="card-header">
        <h3>Orders</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>INV</th>
                        <th>Date</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Total</th>
                        <th>Resi</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->invoice_number }}</td>
                            <td>{{ $invoice->created_at }}</td>
                            <td class="text-center">
                                @if ($invoice->payment_status == 0)
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($invoice->payment_status == 1)
                                    <span class="badge bg-success">Success</span>
                                @else
                                    <span class="badge bg-danger">Failed</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($invoice->delivery_status == 0)
                                    <span class="badge bg-warning">Waiting</span>
                                @elseif($invoice->delivery_status == 1)
                                    <span class="badge bg-primary">On Delivery</span>
                                @elseif($invoice->delivery_status == 2)
                                    <span class="badge bg-success">Delivered</span>
                                @else
                                    <span class="badge bg-danger">Failed</span>
                                @endif
                            </td>
                            <td>@rupiah($invoice->price + $invoice->delivery_fee)</td>
                            <td>{{ $invoice->resi_number }}</td>
                            <td>
                                @if ($invoice->payment_status == 0)
                                    @if (Auth::check())
                                        <a wire:click="pay('{{ $invoice->id }}')"
                                            class="btn btn-fill-out btn-sm">Pay</a>
                                    @else
                                        <a target="_blank"
                                            href="https://app-sandbox.duitku.com/redirect_checkout?reference={{ $invoice->payment_reference }}&lang=id"
                                            class="btn btn-fill-out btn-sm">Pay</a>
                                    @endif
                                @elseif($invoice->payment_status == 1)
                                    @if (Auth::check())
                                        <a href=" {{ route('invoice.detail', ['inv' => $invoice->invoice_number]) }}"
                                            target="_blank" class="btn btn-fill-out btn-sm">View</a>
                                    @else
                                        <a href=" {{ route('invoice.guest.detail', ['inv' => $invoice->invoice_number, 'reference' => $invoice->payment_reference]) }}"
                                            target="_blank" class="btn btn-fill-out btn-sm">View</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
