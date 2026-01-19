<?php
/**
 *
 * @class VideoService
 * @package App\Services\Video
 */

namespace App\Services;

use App\DTOs\Video\CreateVideoDTO;
use App\DTOs\Video\EditVideoDTO;
use App\Models\Channel;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoService
{
    public function store(Channel $channel, CreateVideoDTO $createVideoData): Video
    {
        return $channel->videos()->create([
            'uid'         => uniqid(true),
            'title'       => $createVideoData->title,
            'description' => $createVideoData->description,
            'duration'    => '',
            'visibility'  => Video::VISIBILITY_DEFAULT,
            'path'        => $createVideoData->path,
        ]);
    }

    public function update(Video $video, EditVideoDTO $dto): Video
    {
        return $video->update([
            'title'       => $dto->title,
            'description' => $dto->description,
            'visibility'  => $dto->visibility
        ]);
    }

    public function delete(Video $video): bool
    {
        $deleted = Storage::disk('videos')->deleteDirectory($video->uid);

        if ($deleted) {
            return (bool) $video->delete();
        }

        return false;
    }
}
