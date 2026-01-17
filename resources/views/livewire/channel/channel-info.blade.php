<div>
    <div class="d-flex align-content-center">
        <div class="d-flex align-items-center">
            @include('partials.channel-image')
            <div class="m-1">
                <h5>
                    <a href="{{ route('channel.index', ['channel' => $channel]) }}" class="gray-text">
                        {{$channel->name}}
                    </a>
                </h5>
                <p class="gray-text text-sm m-0">{{$channel->subscribers()}} subscriber(s)</p>
            </div>
        </div>
        <div class="px-3">
            <button wire:click.prevent="toggle"
                    class="btn text-uppercase btn-primary rounded">
                {{$userSubscribed ? 'Subscribed' : 'Subscribe'}}
            </button>
        </div>
    </div>
</div>
