@extends('layouts.backend')
@push('css')
    <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>

    <script>
        window.addEventListener('showConfirmModal', event => {
            Swal.fire({
                title: 'Confirm Delete',
                text: 'Are you sure you want to delete this item?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteInvoice');
                }
            });
        })
        window.addEventListener('show-invoice', event => {
            Livewire.emit('setShowInvoice', event.detail);
            $('#modal-show-invoice').modal('show');
        })
        window.addEventListener('edit-invoice', event => {
            Livewire.emit('setEditInvoice', event.detail);
            $('#modal-edit-invoice').modal('show');
        })
        window.addEventListener('notifyUpdate', event => {
            Livewire.emit('reRenderTable');
            $('#modal-edit-invoice').modal('hide');
            $('#modal-show-invoice').modal('hide');
        })
    </script>
@endpush

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Invoices Table</h2>

        <!-- Full Table -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Invoices</h3>
            </div>
            <div class="block-content">
                @livewire('invoices.table-component')
            </div>
        </div>
        <!-- END Full Table -->
    </div>
    <!-- END Page Content -->


    <!-- Show Invoice Modal -->
    <div class="modal" id="modal-show-invoice" tabindex="-1" role="dialog" aria-labelledby="modal-extra-large"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Detail Invoice</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        @include('alerts.all-alert')
                        @livewire('invoices.show-invoice')
                    </div>
                    <div class="block-content block-content-full block-content-sm text-end border-top">
                        <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Show Invoice Modal -->

    <!-- Edit Invoice Modal -->
    <div class="modal" id="modal-edit-invoice" tabindex="-1" role="dialog" aria-labelledby="modal-extra-large"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Edit Invoice</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        @include('alerts.all-alert')
                        @livewire('invoices.edit-invoice')
                    </div>
                    <div class="block-content block-content-full block-content-sm text-end border-top">
                        <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END edit Invoice Modal -->
@endsection
