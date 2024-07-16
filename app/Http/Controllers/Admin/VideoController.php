<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::paginate(10);
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.videos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'video_url' => 'required',
            'category_id' => 'required',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:512',
        ]);

        // validate youtube url
        if (strpos($request->video_url, 'youtube.com') == false && strpos($request->video_url, 'youtu.be') == false) {
            return back()->with('error', 'Invalid youtube url');
        }

        // generate unique slug
        $request['slug'] = \Str::slug($request->title);

        if (Video::where('slug', $request->slug)->exists()) {
            $request['slug'] = $request->slug . '-' . rand(1000, 9999);
        }

        try {
            if ($request->hasFile('thumbnail_image')) {
                $thumbnail = $request->file('thumbnail_image');
                // thumbnail name is title + time + file extension
                $thumbnailName = $request->slug.'-'.time() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('storage/videos-thumbnails'), $thumbnailName);
                $request['thumbnail'] = 'storage/videos-thumbnails/' . $thumbnailName;

                unset($request['thumbnail_image']);
            }

            Video::create($request->all());

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }



        return redirect()->route('admin.videos.index');
    }

    public function edit(Video $video)
    {
        $categories = Category::all();
        return view('admin.videos.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'video_url' => 'required',
            'category_id' => 'required',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:512',
        ]);

        // validate youtube url
        if (strpos($request->video_url, 'youtube.com') == false && strpos($request->video_url, 'youtu.be') == false) {
            return back()->with('error', 'Invalid youtube url');
        }

        try {
            if ($request->hasFile('thumbnail_image')) {
                $thumbnail = $request->file('thumbnail_image');
                // thumbnail name is title + time + file extension
                $thumbnailName = $request->slug.'-'.time() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('storage/videos-thumbnails'), $thumbnailName);
                $request['thumbnail'] = 'storage/videos-thumbnails/' . $thumbnailName;

                unset($request['thumbnail_image']);
            }

            $video->update($request->all());

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }

        return redirect()->route('admin.videos.index');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('admin.videos.index');
    }
}
