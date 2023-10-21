<div>
    <!-- END Header -->
    @include('alerts.all-alert')
    <form class="js-validation-signin px-4" wire:submit.prevent="login">
        <div class="form-floating mb-4">
            <input type="email" class="form-control  @error('email') is-invalid @enderror" id="login-email"
                name="login-email" placeholder="Enter your email" wire:model='email'>
            <label class="form-label" for="login-email">Email</label>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-floating mb-4">
            <input type="password" class="form-control  @error('password') is-invalid @enderror" id="login-password"
                name="login-password" placeholder="Enter your password" wire:model="password">
            <label class="form-label" for="login-password">Password</label>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="login-remember-me"
                    name="login-remember-me"  wire:model="remember">
                <label class="form-check-label" for="login-remember-me">Remember Me</label>
            </div>
        </div>
        <div class="mb-4">
            <button type="submit" class="btn btn-lg btn-alt-primary fw-semibold">
                Sign In
            </button>
            <div class="mt-4">
            </div>
        </div>
    </form>
</div>
