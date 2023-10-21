<div class="card-body">
    <form wire:submit.prevent='editAccount'>
        <div class="row">
            <div class="form-group col-12 mb-3">
                <label>Full Name <span class="required">*</span></label>
                <input required="" class="form-control @error('user.name') is-invalid @enderror" name="name" type="text" wire:model='user.name'>
                @error('user.name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-12 mb-3">
                <label>Email Address <span class="required">*</span></label>
                <input required="" class="form-control" name="email" type="email" value="{{ $user->email }}"
                    disabled>
            </div>
            <div class="form-group col-md-12 mb-3">
                <label>Current Password</label>
                <input  class="form-control @error('old_password') is-invalid @enderror" name="password" type="password" wire:model='old_password'>
                @error('old_password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-12 mb-3">
                <label>New Password <span class="required">* Required if password filled</span></label>
                <input  class="form-control @error('password') is-invalid @enderror" name="npassword" type="password" wire:model='password'>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-12 mb-3">
                <label>Confirm Password <span class="required">*</span></label>
                <input  class="form-control @error('password_confirmation') is-invalid @enderror"
                    name="cpassword" type="password" wire:model='password_confirmation'>
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Save</button>
            </div>
        </div>
    </form>
</div>
