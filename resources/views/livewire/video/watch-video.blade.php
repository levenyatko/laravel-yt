<div>
    @push('custom-css')
        <link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
    @endpush
    <div class="container-fluid">
        @if(!$video->processed)
            <div class="row justify-content-center">
                <div class="col-md-8 text-center my-5">
                    <div class="alert alert-warning">
                        <h4 class="alert-heading">Lost Media?</h4>
                        <p>This video is currently being processed. Please come back later.</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="video-container">
                    <div class="video-container" wire:ignore>
                        <video controls preload="auto" id="yt-video"
                               class="video-js vjs-fill vjs-styles=defaults vjs-big-play-centered"
                               data-setup="{}"
                               poster="{{asset($video->thumbnail)}}"
                        >
                            @if($video->processed)
                                <source src="{{ asset('videos/'. $video->uid . '/' . $video->processed_file)}}"
                                        type="application/x-mpegURL" />
                            @endif
                            <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a
                                web browser that
                                <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5
                                    video</a>
                            </p>
                        </video>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <h1 class="mt-4">{{ $video->title }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex flex-row justify-content-between">
                            <livewire:channel.channel-info :channel="$video->channel" />
                            <livewire:video.voting :video="$video" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-3 mt-4 bg-secondary rounded">
                            <p class="gray-text m-0">{{ $video->viewsCount }} view(s) | {{$video->uploaded_date}}</p>
                            <p class="m-0">
                                {!! nl2br(e($video->description)) !!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>{{$video->AllCommentsCount()}} Comment(s)</h4>
                    @auth
                        <div class="my-2">
                            <livewire:comment.add-comment :video="$video" :col=0 :key="$video->id " />
                        </div>
                    @endauth
                    <livewire:comment.all-comments :video="$video" />
                </div>
            </div>
        </div>

        @push('custom-js')
            <script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>

            <script>
                var player = videojs('yt-video')
                player.on('timeupdate', function() {
                    if (this.currentTime() > 3)  {
                        this.off('timeupdate')
                        Livewire.dispatch('VideoViewed')
                    }
                })
            </script>
        @endpush
    </div>
</div>
