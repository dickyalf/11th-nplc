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
                    Livewire.emit('deleteSlider');
                }
            });
        })

        window.addEventListener('update-slider', event => {
            Livewire.emit('setSliderEdit', event.detail);
            $('#modal-edit-slider').modal('show');
        })

        window.addEventListener('notifyUpdate', event => {
            Livewire.emit('reRenderTable');
            $('#modal-edit-slider').modal('hide');
            $('#modal-add-slider').modal('hide');
        })
    </script>
@endpush
<div class="table-responsive">
    <button type="button" class="btn btn-outline-success me-1 mb-3" data-bs-toggle="modal"
        data-bs-target="#modal-add-slider">
        <i class="fa fa-plus opacity-50 me-1"></i>Add Slider
    </button>
    @include('alerts.all-alert')
    <table class="table table-striped table-vcenter">
        <thead>
            <tr>
                <th class="text-center" style="width: 100px;">#</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>CTA</th>
                <th>Created At</th>
                <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
        </thead>
        <tbody>

            @if (count($slider) == 0)
                <tr>
                    <td colspan="6" class="text-center">
                        No data!
                    </td>
                </tr>
            @endif

            @foreach ($slider as $slide)
                <tr>
                    <td class="text-center">
                        <img class="img-avatar img-avatar48" src="{{ asset('storage/' . $slide->image) }}"
                            alt="">
                    </td>
                    <td class="fw-semibold">{{ $slide->title }}</td>
                    <td>{{ $slide->subtitle }}</td>
                    <td>{{ $slide->action_title && $slide->action_url ? $slide->action_title : '-' }}</td>
                    <td>{{ $slide->created_at }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="" wire:click.prevent="edit({{ $slide }})"
                                class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="Edit">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <button type="button" wire:click="confirmDelete({{ $slide->id }})"
                                class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="Delete">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
