<div>
    <form wire:submit.prevent='editSlider' class="px-4">
        <div class="form-floating mb-4">
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                name="title" placeholder="title" wire:model='slider.title'>
            <label class="form-label" for="title">Title</label>
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-floating mb-4">
            <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle"
                name="subtitle" placeholder="subtitle" wire:model='slider.subtitle'>
            <label class="form-label" for="subtitle">Subtitle</label>
            @error('subtitle')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-floating mb-4">
            <select class="form-select @error('cta') is-invalid @enderror" id="cta" name="cta"
                aria-label="CTA" wire:model="cta">
                <option selected="">Select an option</option>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            <label class="form-label" for="example-select-floating">Set Call To Action</label>
            @error('cta')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        @if ($cta == 1)
            <div class="form-floating mb-4">
                <input type="text" class="form-control @error('cta_title') is-invalid @enderror" id="cta_title"
                    name="cta_title" placeholder="cta_title" wire:model='slider.action_title'>
                <label class="form-label" for="cta_title">CTA Title</label>
                @error('cta_title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-floating mb-4">
                <input type="text" class="form-control @error('cta_url') is-invalid @enderror" id="cta_url"
                    name="cta_url" placeholder="cta_url" wire:model='slider.action_url'>
                <label class="form-label" for="cta_url">CTA Url</label>
                @error('cta_url')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endif

        <div>
            <button type="submit" class="btn btn-alt-primary mb-4">
                Edit Slider
            </button>
        </div>
    </form>
</div>
