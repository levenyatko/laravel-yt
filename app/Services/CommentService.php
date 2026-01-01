<?php
/**
 *
 * @class CommentService
 * @package App\Services\Comment
 */

namespace App\Services;

use App\DTOs\Comment\CreateCommentDTO;

class CommentService
{
    public function store($comments, CreateCommentDTO $dto)
    {
        return $comments->create([
            'body'      => $dto->body,
            'video_id'  => $dto->video_id,
            'parent_id' => $dto->parent_id,
        ]);

    }

}
