<div>
    <div class="d-flex align-items-center">
        @include('partials.channel-image', ['size' => 'small'])
        <input type="text" wire:model="body" class="ms-2 w-100 comment-form-control @error('body') is-invalid @enderror" placeholder="Add a public comment..." required>
    </div>
    <div class="d-flex justify-content-end align-items-center">
        @error('body')
            <span class="invalid-feedback" role="alert" style="display: initial">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <a href="#" wire:click.prevent="resetForm" class="gray-text">Cancel</a>
        <button wire:click.prevent="addComment" class="mx-2 btn btn-primary">COMMENT</button>
    </div>
</div>
