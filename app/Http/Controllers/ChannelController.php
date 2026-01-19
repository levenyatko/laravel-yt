<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index(Channel $channel)
    {
        $data = [
            'channel' => $channel,
            'videos'  => $channel->videos()->published()->get()
        ];
        return view('channel.index', $data);
    }

    public function edit(Channel $channel)
    {
        return view('channel.edit', compact('channel'));
    }
}
