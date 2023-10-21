@extends('layouts.backend')
@push('css')
    <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ckeditor5-classic/build/ckeditor.js') }}"></script>

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
                    Livewire.emit('deleteCharacter');
                }
            });
        })
        window.addEventListener('update-character', event => {
            $('#description-edit').val(event.detail.description);
            Livewire.emit('setCharacterEdit', event.detail);
            $('#modal-edit-character').modal('show');
        })
        window.addEventListener('notifyUpdate', event => {
            Livewire.emit('reRenderTable');
            $('#modal-edit-character').modal('hide');
            $('#modal-add-character').modal('hide');
        })
    </script>
@endpush
@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Characters Table</h2>

        <!-- Full Table -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Characters</h3>
            </div>
            <div class="block-content">
                @livewire('characters.table-component')
            </div>
        </div>
        <!-- END Full Table -->
    </div>
    <!-- END Page Content -->
    <!-- Add Characters Modal -->
    <div class="modal" id="modal-add-character" tabindex="-1" role="dialog" aria-labelledby="modal-extra-large"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Add Characters</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        @livewire('characters.add-character')
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
    <!-- END Add Characters Modal -->

    <!-- Edit Characters Modal -->
    <div class="modal" id="modal-edit-character" tabindex="-1" role="dialog" aria-labelledby="modal-extra-large"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Edit Character</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        @livewire('characters.edit-character')
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
    <!-- END Edit Characters Modal -->
@endsection
