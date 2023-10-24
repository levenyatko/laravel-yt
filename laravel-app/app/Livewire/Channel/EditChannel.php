<?php

namespace App\Livewire\Channel;

use App\DTOs\Channel\EditChannelDTO;
use App\Models\Channel;
use App\Services\ChannelService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Image;

class EditChannel extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    private ChannelService $service;

    public Channel $channel;

    public $name;

    public $slug;

    public $description;

    public $image;

    public function boot(ChannelService $service)
    {
        $this->service = $service;
    }

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

        $this->service->update(
            $this->channel,
            new EditChannelDTO(
                $this->name,
                $this->slug,
                $this->description,
                $this->image,
            )
        );

        session()->flash('message', 'Channel updated');

        return $this->redirect( route('channel.edit', ['channel' => $this->channel->slug]) );
    }

}
