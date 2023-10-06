<?php

namespace App\Livewire\Video;

use App\Models\Video;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Voting extends Component
{
    public $video;

    public $likesCount;

    public $dislikesCount;

    public $likeActive;

    public $dislikeActive;

    protected $listeners = ['load_values' => '$refresh'];

    public function mount(Video $video)
    {
        $this->video = $video;

        $this->updateVotesCount();

        if ( $this->video->doesUserLikedVideo() ) {
            $this->likeActive = true;
            $this->dislikeActive = false;
        } elseif ( $this->video->doesUserDislikeVideo() ) {
            $this->likeActive = false;
            $this->dislikeActive = true;
        } else {
            $this->likeActive = false;
            $this->dislikeActive = false;
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

        Vote::updateOrCreate(
            [
                'video_id' => $this->video->id,
                'user_id' => auth()->id()
            ],
            [
                'is_positive' => true,
            ]
        );

        $this->likeActive = true;
        $this->dislikeActive = false;

        $this->updateVotesCount();

        $this->dispatch('load_values');
    }

    public function dislike()
    {
        if ( ! Auth::check() ) {
            return redirect('/login');
        }

        Vote::updateOrCreate(
            [
                'video_id' => $this->video->id,
                'user_id' => auth()->id()
            ],
            [
                'is_positive' => false,
            ]
        );

        $this->likeActive = false;
        $this->dislikeActive = true;

        $this->updateVotesCount();

        $this->dispatch('load_values');
    }

    private function updateVotesCount()
    {
        $this->likesCount = $this->video->votes->where('is_positive', true)->count();
        $this->dislikesCount = $this->video->votes->where('is_positive', false)->count();
    }
}
