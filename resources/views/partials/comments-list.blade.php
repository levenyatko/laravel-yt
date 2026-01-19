
    @foreach ($comments as $comment)
        <div class="col-md-12 my-3" x-data="{ open: false , openReply:false}">
            <div class="row">
                <div class="col-md-1 mr-3">
                    @include('partials.channel-image', ['channel' => $comment->user->channel, 'size' => 'small'])
                </div>
                <div class="col-md-11">
                    <h5 class="mt-0">
                        {{$comment->user->name}}
                        <small class="text-muted">{{$comment->created_at->diffForHumans()}} </small>
                    </h5>
                    {{$comment->body}}
                    @auth
                        <p class="mt-3">
                            <a href="#" class="text-muted" @click.prevent="openReply = !openReply">REPLY</a>
                        </p>
                        <div class="my-2" x-show="openReply">
                            <livewire:comment.add-comment :video="$video" :col="$comment->id" :key="$comment->id . uniqid() " />
                        </div>
                    @endauth

                    @if ($comment->replies->count())
                        <a href="" @click.prevent="open = !open"> view {{ $comment->replies->count()}} replies</a>
                        <div x-show="open">
                            @include('partials.comments-list', ['comments' => $comment->replies])
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
