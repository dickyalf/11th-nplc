<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $invoice->invoice_number }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/invoice.css') }}" media="all" />
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="{{asset('media/logo.png')}}">
        </div>
        <h1>{{ $invoice->invoice_number }}</h1>
        <div id="company" class="clearfix">
            <div>{{ env('APP_NAME') }}</div>
            <div>{{ env('APP_ADDRESS') }}</div>
            <div>{{ env('APP_PHONE') }}</div>
            <div><a href="mailto:{{ env('APP_EMAIL') }}">{{ env('APP_EMAIL') }}</a></div>
        </div>
        <div id="project">
            <div><span>CUSTOMER</span> {{ isset($invoice->user) ? $invoice->user->name : 'Guest' }}</div>
            <div><span>ADDRESS</span> {{ Str::afterLast($invoice->delivery_address, ')') }}</div>
            <div><span>DATE</span> {{ $invoice->created_at }}</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="product">PRODUCT</th>
                    <th>SOFTFILE</th>
                    <th>PRICE</th>
                    <th>QTY</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->invoiceDetails as $detail)
                    <tr>
                        <td class="product">{{ $detail->product->name }}</td>
                        <td class="t-center">
                            @if ($detail->product->softfile)
                                @if (Auth::check())
                                    <a href="{{ route('file.download', ['invoice' => $invoice->invoice_number, 'product' => $detail->product->id]) }}"
                                        target="_blank">Download</a>
                                @else
                                    <a href="{{ route('file.gdownload', ['invoice' => $invoice->invoice_number, 'product' => $detail->product->id, 'reference' => $invoice->payment_reference]) }}"
                                        target="_blank">Download</a>
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td class="t-center">@rupiah($detail->product->price)</td>
                        <td class="t-center"> {{ $detail->quantity }} </td>
                        <td class="t-center">@rupiah($detail->product->price * $detail->quantity)</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">SUBTOTAL</td>
                    <td class="t-center">@rupiah($invoice->totalPrice)</td>
                </tr>
                <tr>
                    <td colspan="4">Delivery Fee ({{ strtoupper($invoice->delivery_courier) }})</td>
                    <td class="t-center">@rupiah($invoice->delivery_fee)</td>
                </tr>
                <tr>
                    <td colspan="4" class="grand t-center">GRAND TOTAL</td>
                    <td class="grand t-center bold-text">@rupiah($invoice->price + $invoice->delivery_fee)</td>
                </tr>
            </tbody>
        </table>
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>

</html>
