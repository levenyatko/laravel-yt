<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            $channels = Auth::user()->subscribedChannels()->with(['videos' => function ($query) {
                $query->where('visibility', 'public');
            }])->get()->pluck('videos');
        } else {
            $channels = Channel::with(['videos' => function ($query) {
                $query->where('visibility', 'public');
            }])->get()->pluck('videos');
        }

        return view('home', compact('channels'));
    }
}
