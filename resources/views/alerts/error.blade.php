@if (session('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <p class="mb-0">
            {{ session('error') }}
        </p>
    </div>
@endif