<div class="table-responsive">
    <button type="button" class="btn btn-outline-success me-1 mb-3" data-bs-toggle="modal"
        data-bs-target="#modal-add-character">
        <i class="fa fa-plus opacity-50 me-1"></i>Add Character
    </button>
    @include('alerts.all-alert')
    <table class="table table-striped table-vcenter">
        <thead>
            <tr>
                <th class="text-center" style="width: 100px;">
                    <i class="fa fa-image"></i>
                </th>
                <th>Name</th>
                <th>Created At</th>
                <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
        </thead>
        <tbody>

            @if (count($characters) == 0)
                <tr>
                    <td colspan="4" class="text-center">
                        No data!
                    </td>
                </tr>
            @else
                @foreach ($characters as $character)
                    <tr>
                        <td class="text-center">
                            <img class="img-avatar img-avatar48" src="{{ asset('storage/' . $character->image) }}"
                                alt="">
                        </td>
                        <td class="fw-semibold">{{ $character->name }}</td>
                        <td>{{ $character->created_at }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="" wire:click.prevent="edit({{ $character }})"
                                    class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="Edit">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <button type="button" wire:click="confirmDelete({{ $character->id }})"
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
