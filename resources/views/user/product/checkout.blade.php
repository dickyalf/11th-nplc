@extends('layouts.user.master')

@push('js')
    <script src="https://app-sandbox.duitku.com/lib/js/duitku.js"></script>
    <script>
        window.addEventListener('payment', event => {
            checkout.process(event.detail.reference, {
                defaultLanguage: "id",
                successEvent: function(result) {
                    toastr["success"]("Payment Success");
                    setTimeout(function() {
                        window.location.href = "{{ route('completed') }}";
                    }, 1200);
                },
                pendingEvent: function(result) {
                    toastr["warning"]("Payment Pending");
                    setTimeout(function() {
                        window.location.href = "{{ route('invoices') }}";
                    }, 1200);
                },
                errorEvent: function(result) {
                    toastr["error"]("Payment Error");
                    setTimeout(function() {
                        window.location.href = "{{ route('invoices') }}";
                    }, 1200);
                },
                closeEvent: function(result) {
                    toastr["info"]("Payment Close");
                    setTimeout(function() {
                        window.location.href = "{{ route('invoices') }}";
                    }, 1200);
                }
            });

        })

        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        window.addEventListener('save', event => {
            var invString = '';
            if (getCookie('invoices')) {
                let invoices;
                try {
                    invoices = JSON.parse(getCookie('invoices'));
                    invoices.push(event.detail.data);
                } catch (e) {
                    invoices = [];
                    invoices.push(event.detail.data);
                }
                invString = JSON.stringify(invoices);
            } else {
                let invoices = [];
                invoices.push(event.detail.data);
                invString = JSON.stringify(invoices);
            }
            document.cookie = "invoices=" + invString;
            console.log("save to cookie");
        });
    </script>
@endpush

@section('content')
    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="toggle_info">
                        @if (Auth::check())
                            <span><i class="fas fa-user"></i>{{ Auth::user()->name }}</span>
                        @else
                            <span><i class="fas fa-user"></i>Returning customer? <a href="{{ route('login') }}">Click here to
                                    login</a></span>
                        @endif

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="medium_divider"></div>
                    <div class="divider center_icon"><i class="linearicons-credit-card"></i></div>
                    <div class="medium_divider"></div>
                </div>
            </div>
            @livewire('master.checkout-component')
        </div>
    </div>
    <!-- END SECTION SHOP -->
@endsection
