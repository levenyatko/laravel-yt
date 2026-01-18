<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Video;
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
        $videos = collect([]);

        if (Auth::check()) {
            $videos = Auth::user()->subscribedChannels()->with(['videos' => function ($query) {
                $query->where('visibility', 'public');
            }])->get()->pluck('videos');
        }

        if ($videos->isEmpty()) {
            $videos = Video::query()->where('visibility', 'public')->get();
        }

        return view('home', compact('videos'));
    }
}
