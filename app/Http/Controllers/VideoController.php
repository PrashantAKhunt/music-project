<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function index(Request $request)
    {
        $selectedCategories = $request->category;
        $searchTerm = $request->search;
        $allCategories = Category::whereHas('videos')->get();

        // convert selectedCategories to array
        if ($selectedCategories) {
            $selectedCategories = explode(',', $selectedCategories);
        }
        $categoryName = Category::where('id', $selectedCategories)->first()->name ?? '';
        if ($selectedCategories && $searchTerm) {
            $videos = Video:: where(function ($query) use ($searchTerm) {
                        $query->where('title', 'like', '%' . $searchTerm . '%')
                                ->orWhere('description', 'like', '%' . $searchTerm . '%');
                    })
                    ->whereIn('category_id', $selectedCategories)
                    ->latest()->paginate(10);
        } elseif ($selectedCategories) {
            $videos = Video::whereIn('category_id', $selectedCategories)->latest()->paginate(10);
        } elseif ($searchTerm) {
            $videos = Video::where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%')
                    ->latest()->paginate(10);
        } else {
            $videos = Video::latest()->paginate(10);
        }

        return view('web.videos.index', compact('videos', 'allCategories', 'selectedCategories', 'categoryName', 'searchTerm'));
    }

    public function show($slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();
        $relatedVideos = Video::where('category_id', $video->category_id)->where('id', '!=', $video->id)->latest()->take(3)->get();
        return view('web.videos.play-video', compact('video', 'relatedVideos'));
    }
}
