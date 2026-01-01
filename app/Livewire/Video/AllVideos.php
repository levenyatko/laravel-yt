<?php

namespace App\Livewire\Video;

use App\Models\Channel;
use App\Models\Video;
use App\Services\VideoService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class AllVideos extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected $paginationTheme = 'bootstrap';

    private VideoService $service;

    public $channel;

    public function boot(VideoService $service)
    {
        $this->service = $service;
    }

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function render()
    {
        return view('livewire.video.all-videos')
            ->with('videos', $this->channel->videos()->paginate(3))
            ->extends('layouts.app');
    }

    public function delete(Video $video)
    {
        //check if user is allowed to delete the video
        $this->authorize('delete', $video);

        $this->service->delete( $video );

        return back();
    }
}
