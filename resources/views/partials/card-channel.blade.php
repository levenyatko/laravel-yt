<div class="card">
    <div class="card-body p-2">
        <div class="d-flex align-items-center gap-2">
            <div>
                @include('partials.channel-image')
            </div>
            <div>
                <p class="h3 font-weight-bold m-0 mb-2">
                    <a href="{{ route('channel.index', $subscribedChannel)}}" class="card-link">
                        {{ $channel->name}}
                    </a>
                </p>
                <p class="gray-text text-sm m-0">{{$channel->subscribers()}} subscriber(s)</p>
                <p class="gray-text m-0">{{$channel->description }}</p>
            </div>
        </div>
    </div>
</div>