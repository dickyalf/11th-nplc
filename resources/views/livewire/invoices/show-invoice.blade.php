<div>
    <form class="px-4">
        <div class="form-floating mb-4">
            <input class="form-control" value="{{ $invoice != null ? $invoice->delivery_address : '' }}" disabled>
            <label class="form-label">Delivery Address</label>
        </div>

        <label class="form-label">Products</label>
        <div class="table-responsive">
            <table class="table table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 100px;">
                            <i class="fa fa-shopping-cart"></i>
                        </th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th style="width: 30%;">Price</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice != null ? $invoice->invoiceDetails : [] as $detail)
                        <tr>
                            <td class="text-center">
                                <img class="img-avatar img-avatar48"
                                    src="{{ asset('storage/' . $detail->product->image) }}" alt="">
                            </td>
                            <td class="fw-semibold">{{ $detail->product->name }}</td>
                            <td>
                                @if ($detail->product->category == 1)
                                    <span class="badge bg-success">Hardfile</span> (Need to be delivered)
                                @else
                                    <a href="{{ route('file.view', ['file' => Str::afterLast($detail->product->softfile->file, '/')]) }}"
                                        target="_blank" class="badge bg-primary">Softfile</a>
                                @endif
                            </td>
                            <td>@rupiah($detail->price)</td>
                            <td>
                                {{ $detail->quantity }}
                            </td>
                            <td>@rupiah($detail->price * $detail->quantity)</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" class="text-center ">
                            Sub Total
                        </td>
                        <td>
                            @rupiah($invoice != null ? $invoice->total_price : 0)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center">
                            Delivery Fee ({{ $invoice != null ? $invoice->delivery_courier : '' }})
                        </td>
                        <td>
                            @rupiah($invoice != null ? $invoice->delivery_fee : 0)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center fw-semibold">
                            Total Price
                        </td>
                        <td class="fw-semibold">
                            @rupiah($invoice != null ? $invoice->total_price + ($invoice != null ? $invoice->delivery_fee : 0) : 0)
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </form>
</div>
