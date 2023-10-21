<div class="table-responsive">
    @include('alerts.all-alert')
    <table class="table table-striped table-vcenter">
        <thead>
            <tr>
                <th class="text-center" style="width: 100px;">
                    #
                </th>
                <th>User</th>
                <th>Total Price</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Reference</th>
                <th>Delivery Status</th>
                <th>Resi Number</th>
                <th>Created At</th>
                <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
        </thead>
        <tbody>

            @if (count($invoices) == 0)
                <tr>
                    <td colspan="10" class="text-center">
                        No data!
                    </td>
                </tr>
            @else
                @foreach ($invoices as $invoice)
                    <tr>
                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="fw-semibold">{{ $invoice->user ? $invoice->user->name : 'Guest' }}</td>
                        <td>@rupiah($invoice->totalPrice)</td>
                        <td>{{ isset($invoice->paymentMethod) ? $invoice->paymentMethod->name : "Unknown" }}</td>
                        <td>
                            @if ($invoice->payment_status == 0)
                                <span class="badge bg-warning">Pending</span>
                            @elseif($invoice->payment_status == 1)
                                <span class="badge bg-success">Success</span>
                            @else
                                <span class="badge bg-danger">Failed</span>
                            @endif
                        </td>
                        <td>{{ $invoice->payment_reference }}</td>
                        <td>
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
                        <td>{{ $invoice->resi_number }}</td>
                        <td>{{ $invoice->created_at }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="" wire:click.prevent="edit({{ $invoice }})"
                                    class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="Edit Resi">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <a href="" wire:click.prevent="show({{ $invoice }})"
                                    class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="Detail">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <button type="button" wire:click="confirmDelete({{ $invoice->id }})"
                                    class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
