<?php

namespace App\Livewire\Video;

use App\DTOs\Video\EditVideoDTO;
use App\Enums\VideoVisibility;
use App\Models\Channel;
use App\Models\Video;
use App\Services\VideoService;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class EditVideo extends Component
{
    private VideoService $service;

    public Channel $channel;

    public Video $video;

    public $title;

    public $description;

    public $visibility;

    public function boot(VideoService $service)
    {
        $this->service = $service;
    }

    protected function rules()
    {
        return [
            'title'       => 'required|max:255',
            'description' => 'nullable|max:1000',
            'visibility'  => [ 'required', new Enum( VideoVisibility::class ) ],
        ];
    }

    public function mount(Channel $channel, Video $video)
    {
        $this->channel = $channel;
        $this->video = $video;

        $this->fill(
            $video->only('title', 'description', 'visibility'),
        );
    }

    public function render()
    {
        return view('livewire.video.edit-video')
            ->extends('layouts.app');
    }

    public function update()
    {
        $this->validate();

        if ( VideoVisibility::PUBLIC == $this->visibility && ! $this->video->processed ) {
            session()->flash('message', 'You can\'t puslish video before processing is finished.');
            return;
        }

        $this->video = $this->service->update(
            $this->video,
            new EditVideoDTO(
                title      : $this->title,
                description: $this->description,
                visibility : $this->visibility
            )
        );

        session()->flash('message', 'Video was updated');
    }
}
