<?php
/**
 *
 * @class ChannelService
 * @package App\Services
 */

namespace App\Services;

use App\DTOs\Channel\EditChannelDTO;
use App\Models\Channel;
use Illuminate\Support\Facades\File;
use Image;

class ChannelService
{

    public function update(Channel &$channel, EditChannelDTO $dto)
    {
        $channel_data = $dto->all();

        if ( $dto->image ) {
            $images_dir_path = storage_path( 'app/public/' );

            // remove old image
            if ( $channel->image ) {
                $old_path = $images_dir_path . $channel->image;
                if( File::exists( $old_path ) ) {
                    File::delete( $old_path );
                }
            }

            if ( ! File::isDirectory($images_dir_path) ) {
                File::makeDirectory($images_dir_path, 0777, true, true);
            }

            $img_name = sprintf('images/logo-%s.%s', $channel->uid, $dto->image->getClientOriginalExtension());

            Image::make( $dto->image->getRealPath() )->resize(100, 100)->save( $images_dir_path . $img_name );
            $channel_data['image'] = $img_name;
        }

        $channel->update( $channel_data );
    }
}
