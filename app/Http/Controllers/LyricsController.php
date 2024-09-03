<?php

namespace App\Http\Controllers;

use App\Models\Lyrics;
use App\Models\Category;

use Illuminate\Http\Request;

class LyricsController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategories = $request->category;
        $searchTerm = $request->search;
        $allCategories = Category::whereHas('lyrics')->get();

        // convert selectedCategories to array
        if ($selectedCategories) {
            $selectedCategories = explode(',', $selectedCategories);
        }

        $categoryName = Category::where('id', $selectedCategories)->first()->name ?? '';

        if ($selectedCategories && $searchTerm) {
            $lyrics = Lyrics:: where(function ($query) use ($searchTerm) {
                        $query->where('title', 'like', '%' . $searchTerm . '%')
                                ->orWhere('description', 'like', '%' . $searchTerm . '%');
                    })
                    ->whereIn('category_id', $selectedCategories)
                    ->latest()->paginate(10);
        } elseif ($selectedCategories) {
            $lyrics = Lyrics::whereIn('category_id', $selectedCategories)->latest()->paginate(10);
        } elseif ($searchTerm) {
            $lyrics = Lyrics::where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%')
                    ->latest()->paginate(10);
        } else {
            $lyrics = Lyrics::latest()->paginate(10);
        }

        return view('web.lyrics.index', compact('lyrics', 'allCategories', 'selectedCategories', 'categoryName', 'searchTerm'));
    }

    public function show($slug)
    {
        $lyric = Lyrics::where('slug', $slug)->first();
        if(!$lyric) {
            return redirect()->route('lyrics.index');
        }

        $relatedLyrics = Lyrics::where('category_id', $lyric->category_id)->where('id', '!=', $lyric->id)->get();
        return view('web.lyrics.read-lyrics', compact('lyric', 'relatedLyrics'));
    }
}
