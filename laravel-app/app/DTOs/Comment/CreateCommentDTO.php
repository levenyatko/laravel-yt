<?php
/**
 *
 * @class CreateCommentDTO
 * @package App\DTOs\Comment
 */

namespace App\DTOs\Comment;

class CreateCommentDTO
{
    public function __construct(
        public readonly int $video_id,
        public readonly string $body,
        public readonly ?int $parent_id,
    ) {

    }
}
