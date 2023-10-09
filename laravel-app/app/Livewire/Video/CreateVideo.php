<?php

namespace App\Livewire\Video;

use App\Jobs\ConvertVideoForStreaming;
use App\Jobs\CreateThumbnailFromVideo;
use Livewire\WithFileUploads;
use App\Models\Channel;
use App\Models\Video;
use Livewire\Component;

class CreateVideo extends Component
{
    use WithFileUploads;

    public Channel $channel;

    public Video $video;

    public $videoFile;

    protected $rules = [
        'videoFile' => 'required|mimes:mp4|max:1228800'
    ];

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

        $this->video = $this->channel->videos()->create([
            'uid'         => uniqid(true),
            'title'       => 'untitled',
            'description' => '',
            'duration'    => '',
            'visibility'  => Video::VISIBILITY_DEFAULT,
            'path'        => explode('/', $path)[1]
        ]);

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
