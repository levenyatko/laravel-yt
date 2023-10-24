<?php
/**
 *
 * @class VideoViewService
 * @package App\Services\VideoView
 */

namespace App\Services;

use App\DTOs\VideoView\VideoViewDTO;
use App\Models\VideoViews;

class VideoViewService
{
    public function increase(VideoViewDTO $dto)
    {
        VideoViews::updateOrCreate(
            [
                'video_id' => $dto->video_id,
                'period'   => $dto->period,
            ],
            [
                'views' => \DB::raw('views + 1')
            ]
        );
    }
}
