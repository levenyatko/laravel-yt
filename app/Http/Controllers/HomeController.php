<?php

namespace App\Http\Controllers;

use App\Models\Video;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $videos = auth()->check()
            ? auth()->user()
                ->subscribedChannels()
                ->with(['videos' => fn($query) => $query->published()])
                ->get()
                ->pluck('videos')
                ->flatten()
            : collect();

        if ($videos->isEmpty()) {
            $videos = Video::published()->get();
        }

        return view('home', compact('videos'));
    }
}
