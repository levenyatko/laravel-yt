@extends('layouts.app')

@section('content')
<div class="bg-primary p-3 mb-5">
    <div class="container">
        <div class="d-flex align-items-center">
            @include('partials.channel-image')
            <div class="p-2">
                <h1 class="display-4">{{$channel->name}}</h1>
                <p class="lead">{{$channel->description}}</p>
                <p>{{ $channel->subscribers() }} Subscribers</p>
                <livewire:channel.subscribe :channel="$channel" style="light" />
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            @can('update', $channel)
            <a href="{{route('channel.edit', $channel)}}" class="btn btn-primary">Edit Channel</a>
            @endcan
        </div>
    </div>

    <div>
        <div class="row my-4">
            @foreach ($videos as $video)
            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{ route('video.watch', $video)}}" class="card-link">
                    <div class="card mb-4" style="width: 333px; border:none;">
                        @include('partials.card-video')
                    </div>
                </a>

            </div>
            @endforeach
        </div>

    </div>

</div>
@endsection
