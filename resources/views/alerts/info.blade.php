@if (session('info'))
    <div class="alert alert-primary alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <p class="mb-0">
            {{ session('info') }}
        </p>
    </div>
@endif