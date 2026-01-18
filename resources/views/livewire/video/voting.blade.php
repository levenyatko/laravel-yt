<div>
    <div class="btn-group voting-btn-group" role="group" aria-label="Voting">
        <button type="button"
                @class([
                    'btn btn-primary d-flex align-content-center',
                    'btn-primary' => $likeActive,
                    'btn-secondary' => !$likeActive,
                ])
                wire:click.prevent="like"
            >
            <span class="material-symbols-outlined"
                  style="font-size:1.5rem;cursor: pointer;"
                >
                thumb_up
            </span>
            <span class="ms-1" style="line-height: 1.5">{{$likesCount}}</span>
        </button>
        <button type="button"
                @class([
                    'btn btn-primary d-flex align-content-center',
                    'btn-primary' => $dislikeActive,
                    'btn-secondary' => !$dislikeActive,
                ])
                wire:click.prevent="dislike"
        >
            <span class="material-symbols-outlined"
                  style="font-size:1.5rem;cursor: pointer;"
            >
                thumb_down
            </span>
            <span class="ms-1" style="line-height: 1.5">{{$dislikesCount}}</span>
        </button>
    </div>
</div>
