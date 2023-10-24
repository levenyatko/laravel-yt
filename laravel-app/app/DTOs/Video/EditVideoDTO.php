<?php
/**
 *
 * @class EditVideoDTO
 * @package App\DTOs\Video
 */

namespace App\DTOs\Video;

use App\Enums\VideoVisibility;

class EditVideoDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly VideoVisibility $visibility,
    ) {

    }
}
