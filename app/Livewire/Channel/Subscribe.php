<?php

namespace App\Livewire\Channel;

use App\Models\Channel;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Subscribe extends Component
{
    public Channel $channel;

    public $userSubscribed = false;

    public $btnClass = 'bg-primary';

    public function mount(Channel $channel, string $style = 'default')
    {
        $this->channel = $channel;

        if ('light' === $style) {
            $this->btnClass = 'bg-white';
        }
        if (Auth::check()) {
            if (auth()->user()->isSubscribedTo($this->channel)) {
                $this->userSubscribed = true;
            }
        }
    }

    public function render()
    {
        return view('livewire.channel.subscribe');
    }

    public function toggle()
    {
        if ( !Auth::check() ) {
            return redirect('/login');
        }

        if (auth()->user()->isSubscribedTo($this->channel)) {
            Subscription::where('user_id', auth()->id())->where('channel_id', $this->channel->id)->delete();
            $this->userSubscribed = false;
        } else {
            Subscription::create([
                'user_id' => auth()->id(),
                'channel_id' => $this->channel->id
            ]);
            $this->userSubscribed = true;
        }
    }
}
