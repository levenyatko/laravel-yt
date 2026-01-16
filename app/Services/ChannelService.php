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
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ChannelService
{

    public function update(Channel &$channel, EditChannelDTO $dto)
    {
        $channel_data = $dto->all();

        if ( $dto->image ) {
            $images_dir_path = storage_path('app/public/images/');

            // remove old image
            if ( $channel->image ) {
                $old_path = storage_path('app/public/' . $channel->image);
                if( File::exists( $old_path ) ) {
                    File::delete( $old_path );
                }
            }

            if ( ! File::isDirectory($images_dir_path) ) {
                File::makeDirectory($images_dir_path);
            }

            $manager = new ImageManager(new Driver());

            $image = $manager->read($dto->image);

            $image->resize(100, 100);

            $img_name = sprintf('logo-%s.%s', $channel->uid, $dto->image->getClientOriginalExtension());

            $image->save( $images_dir_path . $img_name );

            $channel_data['image'] = $img_name;
        }

        $channel->update( $channel_data );
    }
}
