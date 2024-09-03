<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use App\Models\Lyrics;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestVideos = Video::latest()->take(5)->get();
        $latestLyrics = Lyrics::latest()->take(5)->get();
        $categories = Category::with('videos', 'lyrics')->get();
        return view('web.index', compact('latestVideos', 'categories', 'latestLyrics'));
    }
}
