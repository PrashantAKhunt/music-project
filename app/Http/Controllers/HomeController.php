<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestVideos = Video::latest()->take(5)->get();

        $categories = Category::with('videos')->get();
        return view('web.index', compact('latestVideos', 'categories'));
    }
}
