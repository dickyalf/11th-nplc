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
                    Livewire.emit('deleteUser');
                }
            });
        })

        window.addEventListener('update-user', event => {
            Livewire.emit('setUserEdit', event.detail);
            $('#modal-edit-user').modal('show');
        })

         window.addEventListener('notifyUpdate', event => {
            Livewire.emit('reRenderTable');
            $('#modal-edit-user').modal('hide');
            $('#modal-add-user').modal('hide');
        })
    </script>
@endpush
<div class="table-responsive">
    <button type="button" class="btn btn-outline-success me-1 mb-3" data-bs-toggle="modal"
        data-bs-target="#modal-add-user">
        <i class="fa fa-plus opacity-50 me-1"></i>Add User
    </button>
    @include('alerts.all-alert')
    <table class="table table-striped table-vcenter">
        <thead>
            <tr>
                <th class="text-center" style="width: 100px;">#</th>
                <th>Name</th>
                <th>Role</th>
                <th>Email</th>
                <th>Created At</th>
                <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
        </thead>
        <tbody>

            @if (count($users) == 0)
                <tr>
                    <td colspan="6" class="text-center">
                        No data!
                    </td>
                </tr>
            @endif

            @foreach ($users as $user)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="fw-semibold">{{ $user->name }}</td>
                    <td>{{$user->role}}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td class="text-center">
                    @if($user->id != auth()->user()->id)
                        <div class="btn-group">
                            <a href="" wire:click.prevent="edit({{$user}})" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="Edit">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <button type="button" wire:click="confirmDelete({{ $user->id }})"
                                class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="Delete">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
