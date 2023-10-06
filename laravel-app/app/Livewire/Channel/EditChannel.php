<?php

namespace App\Livewire\Channel;

use App\Models\Channel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Image;

class EditChannel extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public Channel $channel;

    public $name;

    public $slug;

    public $description;

    public $image;

    protected function rules()
    {
        return [
            'name'        => [
                'required',
                'min:4',
                'max:255',
                Rule::unique('channels', 'name')->ignore($this->channel->id, 'id'),
            ],
            'slug'        => [
                'required',
                'min:4',
                'max:255',
                Rule::unique('channels', 'slug')->ignore($this->channel->id, 'id'),
            ],
            'description' => [
                'nullable',
                'max:1000',
            ],
            'image'      => 'nullable|image|max:1024',
        ];
    }

    public function mountChannel(Channel $channel)
    {
        $this->channel = $channel;

        $this->fill(
            $channel->only('title', 'slug', 'description'),
        );
    }

    public function render()
    {
        return view('livewire.channel.edit-channel');
    }

    public function update()
    {
        $this->authorize('update', $this->channel);

        $this->validate();

        $channel_data = [
            'name'  => $this->name,
            'slug'  => $this->slug,
            'description'  => $this->description,
        ];

        if ( $this->image ) {
            $images_dir_path = storage_path( 'app/public/' );

            // remove old image
            if ( $this->channel->image ) {
                $old_path = $images_dir_path . $this->channel->image;
                if( File::exists( $old_path ) ) {
                    File::delete( $old_path );
                }
            }

            if ( ! File::isDirectory($images_dir_path) ) {
                File::makeDirectory($images_dir_path, 0777, true, true);
            }

            $img_name = sprintf('images/logo-%s.%s', $this->channel->uid, $this->image->getClientOriginalExtension());

            Image::make( $this->image->getRealPath() )->resize(100, 100)->save( $images_dir_path . $img_name );
            $channel_data['image'] = $img_name;
        }

        $this->channel->update($channel_data);

        session()->flash('message', 'Channel updated');

        return $this->redirect( route('channel.edit', ['channel' => $this->channel->slug]) );
    }

}
