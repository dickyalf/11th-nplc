<div>
    @include('alerts.all-alert')
    <form wire:submit.prevent='register'>
        <div class="form-group mb-3 ">
            <input type="text" required="" class="form-control @error('name') is-invalid @enderror" name="name"
                placeholder="Fullname" wire:model='fullname'>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mb-3 ">
            <input type="text" required="" class="form-control @error('email') is-invalid @enderror"
                name="email" placeholder="Your Email" wire:model='email'>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <input class="form-control  @error('password') is-invalid @enderror" required="" type="password"
                name="password" placeholder="Password" wire:model="password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <input class="form-control  @error('confirm-password') is-invalid @enderror" required="" type="password"
                name="confirm-password" placeholder="Confirm Password" wire:model="password_confirmation">
            @error('confirm-password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <button type="submit" class="btn btn-fill-out btn-block" name="register" wire:loading.class="loading" wire:loading.attr="disabled" wire:target="register">Register</button>
        </div>
    </form>
</div>
