@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-3">
            @if(!$channels->count())
                <p>No videos to display.</p>
            @endif
            @foreach ($channels as $channelVideos)
                @foreach ($channelVideos as $video)
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('video.watch', $video)}}" class="card-link">
                            <div class="card mb-4" style="width: 333px; border:none;">
                                @include('partials.card-video')
                            </div>
                        </a>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
