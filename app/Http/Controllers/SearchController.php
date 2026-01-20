<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'query' => ['sometimes', 'nullable', 'string', 'max:255'],
        ]);

        $videos = Video::query()
            ->published()
            ->when($request->filled('query'), function ($query) use ($request) {
                $q = $request->input('query');
                $query->where(function ($query) use ($q) {
                    $query->where('title', 'LIKE', "%{$q}%")
                        ->orWhere('description', 'LIKE', "%{$q}%");
                });
            })
            ->get();

        return view('search', compact('videos'));
    }
}
