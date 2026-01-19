<?php
/**
 *
 * @class CommentService
 * @package App\Services\Comment
 */

namespace App\Services;

use App\DTOs\Comment\CreateCommentDTO;
use App\Models\Comment;
use App\Models\User;

class CommentService
{
    public function store(User $user, CreateCommentDTO $dto): Comment
    {
        return $user->comments()->create([
            'body'      => $dto->body,
            'video_id'  => $dto->video_id,
            'parent_id' => $dto->parent_id,
        ]);

    }

}
