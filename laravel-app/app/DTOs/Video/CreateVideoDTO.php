<?php
/**
 *
 * @class CreateVideoDTO
 * @package App\DTOs\Video
 */

namespace App\DTOs\Video;

use App\Enums\VideoVisibility;
use App\Models\Video;

class CreateVideoDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly VideoVisibility $visibility,
        public readonly string $path,
    ) {

    }

    public static function createWithDefaults(string $path)
    {
        return new self(
            title: '',
            description: '',
            visibility: Video::VISIBILITY_DEFAULT,
            path: $path
        );
    }
}
