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
        <livewire:channel.subscribe :channel="$channel" />
    </div>
</div>