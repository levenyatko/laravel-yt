@include('partials.video-thumbnail')
<div class="card-body p-0 pt-3">
    <div class="d-flex align-items-start">
        <img src="{{ Storage::url( $video->channel->image ) }}"
             class="rounded-circle channel-image"
        >
        <div>
            <h4>{{$video->title}}</h4>
            <p class="text-gray mt-4 font-weight-bold" style="line-height: 0.2px">
                {{ $video->channel->name}}
            </p>
            <p class="text-gray font-weight-bold" style="line-height: 0.2px">
                {{ $video->viewsCount }} views •
                {{$video->created_at->diffForHumans()}}
            </p>
        </div>
    </div>
</div>
