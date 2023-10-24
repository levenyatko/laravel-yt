<?php
/**
 *
 * @class VoteService
 * @package App\Services\Vote
 */

namespace App\Services;

use App\DTOs\Vote\StoreVoteDTO;
use App\Models\Vote;

class VoteService
{
    public function store(StoreVoteDTO $dto)
    {
        Vote::updateOrCreate(
            [
                'video_id' => $dto->video_id,
                'user_id'  => $dto->user_id
            ],
            [
                'is_positive' => $dto->is_positive,
            ]
        );
    }
}
