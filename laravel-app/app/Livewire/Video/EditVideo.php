<?php

namespace App\Livewire\Video;

use App\Models\Channel;
use App\Models\Video;
use Livewire\Component;

class EditVideo extends Component
{
    public Channel $channel;

    public Video $video;

    public $title;

    public $description;

    public $visibility;

    protected function rules()
    {
        $allowed_visibility = array_keys( Video::VISIBILITY );
        $allowed_visibility = implode(',', $allowed_visibility);

        return [
            'title'       => 'required|max:255',
            'description' => 'nullable|max:1000',
            'visibility'  => 'required|in:' . $allowed_visibility,
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

        $this->video->update([
            'title'       => $this->title,
            'description' => $this->description,
            'visibility'  => $this->visibility
        ]);

        session()->flash('message', 'Video was updated');
    }
}
