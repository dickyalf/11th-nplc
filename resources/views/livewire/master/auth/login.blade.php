<div>
    @include('alerts.all-alert')
    <form wire:submit.prevent='login'>
        <div class="form-group mb-3 ">
            <input type="text" required="" class="form-control @error('email') is-invalid @enderror" name="email"
                placeholder="Your Email" wire:model='email'>
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
        <div class="login_footer form-group mb-3">
            <div class="chek-form">
                <div class="custome-checkbox">
                    <input class="form-check-input" type="checkbox" name="checkbox" id="remember" value="" wire:model="remember">
                    <label class="form-check-label" for="remember"><span>Remember
                            me</span></label>
                </div>
            </div>
        </div>
        <div class="form-group mb-3">
            <button type="submit" class="btn btn-fill-out btn-block" name="login" wire:loading.class="loading" wire:loading.attr="disabled" wire:target="login">Log in</button>
        </div>
    </form>
</div>
