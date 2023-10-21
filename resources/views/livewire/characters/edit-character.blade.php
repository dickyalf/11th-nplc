@push('js')
    <script>
        let ckEditor;
        document.addEventListener('initEdit', function(event) {
            if (ckEditor) {
                ckEditor.setData(event.detail.description);
            } else {
                ClassicEditor
                    .create(document.querySelector('#description-edit'))
                    .then(editor => {
                        ckEditor = editor
                        editor.model.document.on('change:data', () => {
                            @this.set('description', editor.getData());
                        });
                    })
                    .catch(error => {
                        console.error('There was a problem initializing the classic editor.', error);
                    });
            }
        });
    </script>
@endpush

<div>
    <form wire:submit.prevent='editCharacter' class="px-4" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="form-label" for="image">Image (Optional)</label>
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
                placeholder="Character name" wire:model='name'>
            <label class="form-label" for="name">Character Name</label>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-floating mb-4" wire:ignore>
            <textarea id="description-edit" name="description" wire:model="description"></textarea>
            @error('description')
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
