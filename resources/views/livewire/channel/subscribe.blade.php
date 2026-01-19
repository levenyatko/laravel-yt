<div>
    @if (auth()->check() && !$channel->isOwnedBy(auth()->user()))
        <button wire:click.prevent="toggle"
                class="btn text-uppercase rounded {{ $btnClass }}">
            {{$userSubscribed ? 'Subscribed' : 'Subscribe'}}
        </button>
    @endif
</div>
