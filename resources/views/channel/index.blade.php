@extends('layouts.app')

@section('content')
<div class="bg-primary p-3 mb-5">
    <div class="container" style="position: relative;">
        <div class="d-flex align-items-center">
            @include('partials.channel-image')
            <div class="p-2">
                <h1 class="display-4">{{$channel->name}}</h1>
                <p class="lead">{{$channel->description}}</p>
                <p>{{ $channel->subscribers() }} Subscribers</p>
                <livewire:channel.subscribe :channel="$channel" style="light" />
            </div>
        </div>
        @if (auth()->check() && $channel->isOwnedBy(auth()->user()))
            <div class="dropdown" style="display: block; position: absolute; top: 0; right: -50px">
                <a href="#" class="d-block btn bg-white rounded text-decoration-none" id="dropdownChannel" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="material-symbols-outlined">menu</i>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownChannel">
                    <li>
                        @can('update', $channel)
                            <a class="dropdown-item" href="{{route('channel.edit', $channel)}}">Edit Channel</a>
                        @endcan
                    </li>
                </ul>
            </div>
        @endif
    </div>
</div>


<div class="container">
    @if (!$subscribedChannels->isEmpty())
        <div class="row my-4">
            <h4>My subscriptions</h4>
            @foreach ($subscribedChannels as $subscribedChannel)
                <div class="col-12 col-md-4">
                    @include('partials.card-channel', ['channel' => $subscribedChannel])
                </div>
            @endforeach
        </div>
    @endif
    @if (!$favourites->isEmpty())
        <div class="row my-4">
            <h4>My favourites</h4>
            @foreach ($favourites as $video)
                <div class="col-12 col-md-4">
                    <a href="{{ route('video.watch', $video)}}" class="card-link">
                        <div class="card mb-4" style="width: 333px; border:none;">
                            @include('partials.card-video')
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
    @if (!$videos->isEmpty())
        <div class="row my-4">
            <h4>Videos</h4>
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
    @endif
</div>
@endsection
