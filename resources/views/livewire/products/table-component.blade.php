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
                    Livewire.emit('deleteItem');
                }
            });
        })

        window.addEventListener('update-product', event => {
            Livewire.emit('setProductEdit', event.detail);
            $('#modal-edit-product').modal('show');
        })

        window.addEventListener('notifyUpdate', event => {
            Livewire.emit('reRenderTable');
            $('#modal-edit-product').modal('hide');
            $('#modal-add-product').modal('hide');
        })
    </script>
@endpush
<div class="table-responsive">
    <button type="button" class="btn btn-outline-success me-1 mb-3" data-bs-toggle="modal"
        data-bs-target="#modal-add-product">
        <i class="fa fa-plus opacity-50 me-1"></i>Add Product
    </button>
    @include('alerts.all-alert')
    <table class="table table-striped table-vcenter">
        <thead>
            <tr>
                <th class="text-center" style="width: 100px;">
                    <i class="fa fa-bag-shopping"></i>
                </th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Category</th>
                <th>Weight</th>
                <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
        </thead>
        <tbody>

            @if (count($products) == 0)
                <tr>
                    <td colspan="7" class="text-center">
                        No data!
                    </td>
                </tr>
            @endif

            @foreach ($products as $product)
                <tr>
                    <td class="text-center">
                        <img class="img-avatar img-avatar48" src="{{ asset("storage/".$product->image) }}" alt="">
                    </td>
                    <td class="fw-semibold">{{ $product->name }}</td>
                    <td>@rupiah($product->price)</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                    @if($product->category == 1)
                        <span class="badge bg-success">Hardfile</span>
                    @else
                        <a href="{{ route('file.view', ['file' => Str::afterLast($product->softfile->file, '/')]) }}" target="_blank" class="badge bg-primary">Softfile</a>
                    @endif
                    </td>
                    <td>{{ $product->weight }} gram</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="" wire:click.prevent="edit({{$product}})" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="Edit">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <button type="button" wire:click="confirmDelete({{ $product->id }})"
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
