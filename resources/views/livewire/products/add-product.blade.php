<div>
    <form wire:submit.prevent='addProduct' class="px-4" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="form-label" for="image">Image</label>
            <input class="form-control  @error('image') is-invalid @enderror" type="file" id="image" name="image"
                accept="image/*" wire:model='image'>
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-4">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                placeholder="Product name" wire:model='name'>
            <label class="form-label" for="name">Name</label>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-4">
            <textarea class="form-control" id="description" name="description" rows="4"
                placeholder="Description..." wire:model="description"></textarea>
            <label class="form-label" for="description">Description</label>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-4">
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                name="quantity" placeholder="Product Quantity" wire:model='quantity'>
            <label class="form-label" for="quantity">Quantity</label>
            @error('quantity')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-4">
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                name="price" placeholder="Product Price" wire:model='price'>
            <label class="form-label" for="price">Price</label>
            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-4">
            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category"
                aria-label="Category" wire:model="category">
                <option selected="">Select an option</option>
                <option value="0">Softfile</option>
                <option value="1">Hardfile</option>
            </select>
            <label class="form-label" for="example-select-floating">Category</label>
            @error('category')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div id="softfile-field" class="mb-4 {{ $category == 0 && isset($category) ? '' : 'd-none' }}">
            <label class="form-label" for="softfile">Softfile</label>
            <input class="form-control  @error('softfile') is-invalid @enderror" type="file" id="softfile"
                name="softfile" accept="application/pdf" wire:model='softfile'>
            @error('softfile')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-4 {{ $category == 1 && isset($category) ? '' : 'd-none' }}">
            <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight"
                name="weight" placeholder="Product Weight" wire:model='weight'>
            <label class="form-label" for="weight">Weight (gram)</label>
            @error('weight')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-alt-primary mb-4">
                Add
            </button>
        </div>
    </form>
</div>
