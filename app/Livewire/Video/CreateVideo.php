<?php

namespace App\Livewire\Video;

use App\DTOs\Video\CreateVideoDTO;
use App\Jobs\ConvertVideoForStreaming;
use App\Jobs\CreateThumbnailFromVideo;
use App\Models\Channel;
use App\Models\Video;
use App\Services\VideoService;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateVideo extends Component
{
    use WithFileUploads;

    private VideoService $service;

    public Channel $channel;

    public Video $video;

    public $videoFile;

    protected $rules = [
        'videoFile' => 'required|mimes:mp4|max:1228800'
    ];

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
        return view('livewire.video.create-video')
            ->extends('layouts.app');
    }

    public function fileCompleted()
    {
        $this->validate();

        $path = $this->videoFile->store('videos-temp');

        $this->video = $this->service->store(
            $this->channel->videos(),
            CreateVideoDTO::createWithDefaults( explode('/', $path)[1] )
        );

        //dispatch jobs
        CreateThumbnailFromVideo::dispatch($this->video);
        ConvertVideoForStreaming::dispatch($this->video);

        //redirect to edit route
        return redirect()->route('video.edit', [
            'channel' => $this->channel,
            'video'   => $this->video,
        ]);
    }
}
