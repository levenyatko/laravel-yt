<div>
    <div class="btn-group voting-btn-group" role="group" aria-label="Voting">
        <button type="button"
                class="btn btn-secondary d-flex align-content-center @if($likeActive) btn-icon-filled @endif"
                wire:click.prevent="like"
            >
            <span class="material-symbols-outlined"
                  style="font-size:2rem;cursor: pointer;"
                >
                thumb_up
            </span>
            <span class="m-1">{{$likesCount}}</span>
        </button>
        <button type="button"
                class="btn btn-secondary d-flex align-content-center  @if($dislikeActive) btn-icon-filled @endif"
                wire:click.prevent="dislike"
        >
            <span class="material-symbols-outlined"
                  style="font-size:2rem;cursor: pointer;"
            >
                thumb_down
            </span>
            <span class="m-1">{{$dislikesCount}}</span>
        </button>
    </div>
    @guest
        <p class="gray-text">Login to vote.</p>
    @endguest
</div>
