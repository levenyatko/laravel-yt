<div>
    <div class="d-flex align-items-center">
        <img src="{{ asset('/storage/' .  auth()->user()->channel->image)}}" class="rounded-img" style="height: 40px;">

        <input type="text" wire:model="body" class="my-2 comment-form-control" placeholder="Add a public comment...">
    </div>

    <div class="d-flex justify-content-end align-items-center">
        <a href="#" wire:click.prevent="resetForm" class="gray-text">Cancel</a>
        <button wire:click.prevent="addComment" class="mx-2 btn btn-primary">COMMENT</button>
    </div>
</div>
