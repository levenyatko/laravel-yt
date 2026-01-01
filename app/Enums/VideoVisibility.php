<?php
/**
 *
 * @class VideoVisibility
 * @package App\Enums
 */

namespace App\Enums;

enum VideoVisibility : string
{
    case Private = 'private';
    case Public = 'public';
    case Unlisted = 'unlisted';
}
