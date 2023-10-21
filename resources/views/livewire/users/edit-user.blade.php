<div>
    <form wire:submit.prevent='editUser' class="px-4">
        <div class="form-floating mb-4">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                placeholder="User name" wire:model='name'>
            <label class="form-label" for="name">Name</label>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-4">
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                placeholder="User email" wire:model='email'>
            <label class="form-label" for="email">Email</label>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-4">
            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role"
                aria-label="Role" wire:model="role">
                <option selected="">Select an option</option>
                <option value="user" @if($role == "user") {{"selected"}} @endif>Regular User</option>
                <option value="admin" @if($role == "admin") {{"selected"}} @endif>Super Admin</option>
            </select>
            <label class="form-label" for="role">Role</label>
            @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-4">
            <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                placeholder="User password" wire:model='password'>
            <label class="form-label" for="password">Password (optional)</label>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-alt-primary mb-4">
                Edit
            </button>
        </div>
    </form>
</div>
