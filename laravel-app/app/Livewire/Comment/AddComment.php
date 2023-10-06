<?php

namespace App\Livewire\Comment;

use App\Models\Video;
use Livewire\Component;

class AddComment extends Component
{
    public Video $video;

    public $body;

    public $col;

    protected $rules = [
        'body' => 'required|min:200|max:600'
    ];

    public function mount(Video $video, $col)
    {
        $this->video = $video;
        $this->col = ($col == 0) ? null : $col;
    }

    public function resetForm()
    {
        $this->body = "";
    }

    public function addComment()
    {
        auth()->user()->comments()->create([
            'body'     => $this->body,
            'video_id' => $this->video->id,
            'parent_id' => $this->col,
        ]);

        $this->resetForm();

        $this->dispatch('commentCreated');
    }

    public function render()
    {
        return view('livewire.comment.add-comment');
    }
}
