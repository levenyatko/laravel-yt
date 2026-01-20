@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row my-4">
        @foreach ($videos as $video)
        <div class="card col-12 p-0 mb-4">
            <div class="d-flex align-items-start gap-3">
                @include('partials.video-thumbnail')
                <div class="mt-2">
                    <h4 class="m-0 mb-2">
                        <a href="{{ route('video.watch', $video)}}">
                            {{$video->title}}
                        </a>
                    </h4>
                    <p class="text-gray font-weight-bold m-0  mb-2">
                        <a href="{{ route('channel.index', $video->channel)}}">
                            {{ $video->channel->name}}
                        </a>
                    </p>
                    <p class="text-gray font-weight-bold m-0">
                        {{ $video->viewsCount }} views •
                        {{$video->created_at->diffForHumans()}}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
