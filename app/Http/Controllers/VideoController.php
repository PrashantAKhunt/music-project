<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show($slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();
        $relatedVideos = Video::where('category_id', $video->category_id)->where('id', '!=', $video->id)->latest()->take(3)->get();
        return view('web.videos.play-video', compact('video', 'relatedVideos'));
    }
}
