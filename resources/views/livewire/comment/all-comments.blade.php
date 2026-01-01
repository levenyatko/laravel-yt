<div>
    @include('partials.comments-list', ['comments' => $video->comments()->latestFirst()->get()])
</div>
