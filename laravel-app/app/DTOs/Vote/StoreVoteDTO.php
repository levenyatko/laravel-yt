<?php
/**
 *
 * @class StoreVoteDTO
 * @package App\DTOs\Vote
 */

namespace App\DTOs\Vote;

use App\Enums\VideoVisibility;

class StoreVoteDTO
{
    public function __construct(
        public readonly int $video_id,
        public readonly int $user_id,
        public readonly bool $is_positive,
    ) {

    }

}
