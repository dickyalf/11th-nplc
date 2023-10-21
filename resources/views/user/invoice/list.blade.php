@extends('layouts.user.master')
@push('js')
    <script src="https://app-sandbox.duitku.com/lib/js/duitku.js"></script>
    <script>
        window.addEventListener('payment', event => {
            checkout.process(event.detail.reference, {
                defaultLanguage: "id",
                successEvent: function(result) {
                    toastr["success"]("Payment Success");
                },
                pendingEvent: function(result) {
                    toastr["warning"]("Payment Pending");
                },
                errorEvent: function(result) {
                    toastr["error"]("Payment Error");
                },
                closeEvent: function(result) {
                    toastr["info"]("Payment Close");
                }
            });
        })
        //document.cookie = 'cookie_name=[{"payment_reference":"DS16147233HACROUWKO2WEZ4", "invoice_number":"INV-20230711205833-143"}]';
        //alert("ok");
    </script>
@endpush
@section('content')
    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content dashboard_content">
                        <div class="tab-pane fade active show" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                            @livewire('master.invoices-component')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->
@endsection
