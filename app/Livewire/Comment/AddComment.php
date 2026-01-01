<?php

namespace App\Livewire\Comment;

use App\DTOs\Comment\CreateCommentDTO;
use App\Models\Video;
use App\Services\CommentService;
use Livewire\Component;

class AddComment extends Component
{
    private CommentService $service;

    public Video $video;

    public $body;

    public $col;

    protected $rules = [
        'body' => 'required|min:200|max:600'
    ];

    public function boot(CommentService $service)
    {
        $this->service = $service;
    }

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
        $this->service->store(
            auth()->user()->comments(),
            new CreateCommentDTO($this->video->id, $this->body, $this->col)
        );

        $this->resetForm();

        $this->dispatch('commentCreated');
    }

    public function render()
    {
        return view('livewire.comment.add-comment');
    }
}
