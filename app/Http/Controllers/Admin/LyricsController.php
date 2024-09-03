<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Lyrics;

class LyricsController extends Controller
{
    public function index()
    {
        $lyrics = Lyrics::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.lyrics.index', compact('lyrics'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.lyrics.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:512',
        ]);

        // generate unique slug
        $request['slug'] = \Str::slug($request->title);

        if (Lyrics::where('slug', $request->slug)->exists()) {
            $request['slug'] = $request->slug . '-' . rand(1000, 9999);
        }

        try {
            if ($request->hasFile('thumbnail_image')) {
                $thumbnail = $request->file('thumbnail_image');
                // thumbnail name is title + time + file extension
                $thumbnailName = $request->slug.'-'.time() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('storage/lyrics-thumbnails'), $thumbnailName);
                $request['thumbnail'] = 'storage/lyrics-thumbnails/' . $thumbnailName;

                unset($request['thumbnail_image']);
            }

            Lyrics::create($request->all());

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }

        return redirect()->route('admin.lyrics.index')->with('success', 'Lyrics created successfully');

    }

    public function edit($id)
    {
        $categories = Category::all();
        $lyric = Lyrics::find($id);
        return view('admin.lyrics.edit', compact('categories', 'lyric'));
    }

    public function update(Request $request, $id)
    {
        // validate the request
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:512',
        ]);

        
        $lyric = Lyrics::find($id);

        if (!$lyric) {
            return back()->with('error', 'Lyric not found');
        }

        try {
            if ($request->hasFile('thumbnail_image')) {
                $thumbnail = $request->file('thumbnail_image');
                // thumbnail name is title + time + file extension
                $thumbnailName = $lyric->slug.'-'.time() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('storage/lyrics-thumbnails'), $thumbnailName);
                $lyric->thumbnail = 'storage/lyrics-thumbnails/' . $thumbnailName;

                unset($request['thumbnail_image']);
            }

            $lyric->update($request->all());

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }

        return redirect()->route('admin.lyrics.index')->with('success', 'Lyrics updated successfully');

    }

    public function destroy($id)
    {
        
        $lyric = Lyrics::find($id);

        if (!$lyric) {
            return back()->with('error', 'Lyric not found');
        }

        try {
            $lyric->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }

        return redirect()->route('admin.lyrics.index')->with('success', 'Lyrics deleted successfully');
        
    }
}
