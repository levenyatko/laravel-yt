<div>
    @if( session()->has('message') )
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <form wire:submit.prevent="update">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" wire:model="name" id="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" wire:model="slug" id="slug" class="form-control @error('slug') is-invalid @enderror">
            @error('slug')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" rows="4" class="form-control @error('description') is-invalid @enderror" wire:model="description"></textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" wire:model="image" id="image" class="form-control mb-1 @error('image') is-invalid @enderror">
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @if($image)
                <img src="{{ $image->temporaryUrl() }}" alt="preview" class="img-preview">
            @elseif($channel->image)
                <img src="{{ $channel->image_url }}" alt="logo" class="img-preview">
            @endif
        </div>
        <div class="form-group">
            <button type="submit"
                    class="btn btn-primary"
                    wire:loading.attr="disabled"
                    wire:target="image"
                >
                Submit
            </button>
            <div wire:dirty wire:loading.remove>Unsaved changes...</div>
            <div wire:loading>
                Saving...
            </div>
        </div>
    </form>
</div>
