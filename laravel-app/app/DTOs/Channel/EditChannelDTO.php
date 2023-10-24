<?php
/**
 *
 * @class EditChannelDTO
 * @package App\DTOs\Channel
 */

namespace App\DTOs\Channel;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditChannelDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $slug,
        public readonly string $description,
        public readonly ?TemporaryUploadedFile $image
    ) {

    }

    public function all()
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description
        ];
    }
}
