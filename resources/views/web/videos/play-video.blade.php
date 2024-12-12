@extends('web.layouts.default')

@section('content')

<div class="container mx-auto p-4">
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <!-- Video Section -->
            <div class="md:col-span-9">
                <div class="relative" style="padding-top: 56.25%;">
                    <iframe class="absolute top-0 left-0 w-full h-full" src="{{ $video->video_url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <h2 class="text-2xl font-semibold mt-4">{{ $video->title }}</h2>
                <p class="text-gray-600">{{ $video->description }}</p>
                {{-- category --}}
                <div class="flex items-center mt-4">
                    <div class="bg-blue-600 text-white px-2 py-1 rounded">
                        {{ $video->category->name }}
                    </div>
                </div>
            </div>
            <!-- Related Videos Section -->
            <div class="md:col-span-3 space-y-4">
                @foreach($relatedVideos as $relatedVideo)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <img src="{{ asset($relatedVideo->thumbnail) }}" alt="Video Thumbnail" class="w-full rounded">
                        <h2 class="text-lg font-semibold mt-2">{{ $relatedVideo->title }}</h2>
                        <p class="text-gray-600">{{ $relatedVideo->description }}</p>
                        <a href="{{ route('videos.show', $relatedVideo->slug) }}" class="bg-blue-600 text-white px-2 py-1 rounded mt-2 inline-block">Play Video</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
