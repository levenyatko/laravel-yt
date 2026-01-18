@include('partials.video-thumbnail')
<div class="card-body p-2">
    <div class="d-flex align-items-start gap-2">
        <div>
            @include('partials.channel-image', ['channel'=> $video->channel, 'size' => 'small'])
        </div>
        <div>
            <h4 class="m-0 mb-2">{{$video->title}}</h4>
            <p class="text-gray font-weight-bold m-0  mb-2">
                {{ $video->channel->name}}
            </p>
            <p class="text-gray font-weight-bold m-0">
                {{ $video->viewsCount }} views •
                {{$video->created_at->diffForHumans()}}
            </p>
        </div>
    </div>
</div>
