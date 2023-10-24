<?php

namespace App\Livewire\Video;

use App\DTOs\VideoView\VideoViewDTO;
use App\Models\Video;
use App\Services\VideoViewService;
use Carbon\Carbon;
use Livewire\Component;

class WatchVideo extends Component
{
    private VideoViewService $service;

    public $video;

    protected $listeners = ['VideoViewed' => 'countView'];

    public function boot(VideoViewService $service)
    {
        $this->service = $service;
    }

    public function mount(Video $video)
    {
        $this->video = $video;
    }

    public function render()
    {
        return view('livewire.video.watch-video')
            ->extends('layouts.app');
    }

    public function countView()
    {
        $this->service->increase( new VideoViewDTO( $this->video->id, Carbon::now()->toDateString() ) );
    }
}
