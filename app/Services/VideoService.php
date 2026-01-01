<?php
/**
 *
 * @class VideoService
 * @package App\Services\Video
 */

namespace App\Services;

use App\DTOs\Video\EditVideoDTO;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoService
{
    public function store($channel_videos, $video_file_path)
    {
        return $channel_videos->create([
            'uid'         => uniqid(true),
            'title'       => 'untitled',
            'description' => '',
            'duration'    => '',
            'visibility'  => Video::VISIBILITY_DEFAULT,
            'path'        => $video_file_path
        ]);
    }

    public function update(Video &$video, EditVideoDTO $dto)
    {
        $video->update([
            'title'       => $dto->title,
            'description' => $dto->description,
            'visibility'  => $dto->visibility
        ]);
    }

    public function delete(Video $video)
    {
        $deleted = Storage::disk('videos')->deleteDirectory($video->uid);

        if ($deleted) {
            $video->delete();
        }
    }
}
