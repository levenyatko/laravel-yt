<?php

namespace App\Livewire\Video;

use App\Models\Video;
use App\Models\VideoViews;
use Carbon\Carbon;
use Livewire\Component;

class WatchVideo extends Component
{
    public $video;

    protected $listeners = ['VideoViewed' => 'countView'];

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
        VideoViews::updateOrCreate(
            [
                'video_id' => $this->video->id,
                'period'   => Carbon::now()->toDateString(),
            ],
            [
                'views' => \DB::raw('views + 1')
            ]
        );
    }
}
