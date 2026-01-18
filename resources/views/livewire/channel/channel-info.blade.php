<div>
    <div class="d-flex align-items-center gap-4">
        <div class="d-flex align-items-center gap-2">
            @include('partials.channel-image', ['channel' => $channel, 'size' => 'medium'])
            <div class="m-0">
                <h5>
                    <a href="{{ route('channel.index', ['channel' => $channel]) }}" class="gray-text">
                        {{$channel->name}}
                    </a>
                </h5>
                <p class="gray-text text-sm m-0">{{$channel->subscribers()}} subscriber(s)</p>
            </div>
        </div>
        <div class="">
            <button wire:click.prevent="toggle"
                    class="btn text-uppercase btn-primary rounded">
                {{$userSubscribed ? 'Subscribed' : 'Subscribe'}}
            </button>
        </div>
    </div>
</div>
