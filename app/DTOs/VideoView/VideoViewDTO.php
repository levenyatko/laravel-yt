<?php
/**
 *
 * @class VideoViewDTO
 * @package App\DTOs\VideoView
 */

namespace App\DTOs\VideoView;

class VideoViewDTO
{
    public function __construct(
        public readonly int $video_id,
        public readonly string $period,
    ) {

    }
}
