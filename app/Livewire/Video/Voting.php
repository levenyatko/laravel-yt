<?php

namespace App\Livewire\Video;

use App\DTOs\Vote\StoreVoteDTO;
use App\Models\Video;
use App\Services\VoteService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Voting extends Component
{
    private VoteService $service;

    public $video;

    public $likesCount;

    public $dislikesCount;

    public $likeActive;

    public $dislikeActive;

    protected $listeners = ['load_values' => '$refresh'];

    public function boot(VoteService $service)
    {
        $this->service = $service;
    }

    public function mount(Video $video)
    {
        $this->video = $video;

        $this->updateVotesCount();

        $this->likeActive = false;
        $this->dislikeActive = false;

        if ( $this->video->doesUserLikedVideo() ) {
            $this->setLikeActive();
        } elseif ( $this->video->doesUserDislikeVideo() ) {
            $this->setDislikeActive();
        }
    }

    public function render()
    {
        return view('livewire.video.voting')
            ->extends('layouts.app');
    }

    public function like()
    {
        if ( ! Auth::check() ) {
            return redirect('/login');
        }

        $this->service->store(
            new StoreVoteDTO(
                video_id : $this->video->id,
                user_id : auth()->id(),
                is_positive : true,
            )
        );

        $this->setLikeActive();

        $this->updateVotesCount();

        $this->dispatch('load_values');
    }

    public function dislike()
    {
        if ( ! Auth::check() ) {
            return redirect('/login');
        }

        $this->service->store(
            new StoreVoteDTO(
                video_id : $this->video->id,
                user_id : auth()->id(),
                is_positive : false,
            )
        );

        $this->setDislikeActive();

        $this->updateVotesCount();

        $this->dispatch('load_values');
    }

    private function setLikeActive()
    {
        $this->likeActive    = true;
        $this->dislikeActive = false;
    }

    private function setDislikeActive()
    {
        $this->likeActive    = false;
        $this->dislikeActive = true;
    }

    private function updateVotesCount()
    {
        $this->likesCount    = $this->video->votes->where('is_positive', true)->count();
        $this->dislikesCount = $this->video->votes->where('is_positive', false)->count();
    }
}
