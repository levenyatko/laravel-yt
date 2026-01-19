<?php
/**
 *
 * @class VideoVisibility
 * @package App\Enums
 */

namespace App\Enums;

enum VideoVisibility : string
{
    case PRIVATE = 'private';
    case PUBLIC = 'public';
    case UNLISTED = 'unlisted';
}
