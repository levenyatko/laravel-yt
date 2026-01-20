<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index(Channel $channel)
    {
        $user = auth()->user();

        $subscribedChannels = $channel->isOwnedBy($user)
                                ? $user->subscribedChannels()->get()
                                : collect();

        $favourites = $channel->isOwnedBy($user)
            ? $user->votes()->positive()
                ->with(['video' => fn($query) => $query->published()])
                ->limit(20)
                ->get()
                ->pluck('video')
                ->flatten()
            : collect();

        $data = [
            'channel' => $channel,
            'subscribedChannels' => $subscribedChannels,
            'favourites' => $favourites,
            'videos'  => $channel->videos()->published()->get()
        ];
        return view('channel.index', $data);
    }

    public function edit(Channel $channel)
    {
        return view('channel.edit', compact('channel'));
    }
}
