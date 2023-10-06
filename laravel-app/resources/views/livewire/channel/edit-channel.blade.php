<div>
    @if( $channel->image )
        <img src="{{ Storage::url( $channel->image ) }}" alt="logo" class="img-preview mb-4">
    @endif
    <form wire:submit.prevent="update">
        <div class="form-group mb-2">
            <label for="name">Name</label>
            <input type="text" wire:model="name" id="name" class="form-control">
            @error('name')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="slug">Slug</label>
            <input type="text" wire:model="slug" id="slug" class="form-control">
            @error('slug')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="description">Description</label>
            <textarea id="description" rows="4" class="form-control" wire:model="description"></textarea>
            @error('description')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="image">Image</label>
            <input type="file" wire:model="image" id="image" class="form-control">
            @if($image)
                <img src="{{ $image->temporaryUrl() }}" alt="preview" class="img-preview">
            @endif
            @error('image')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
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
        @if( session()->has('message') )
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </form>
</div>
