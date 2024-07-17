@extends('web.layouts.default')

@section('content')


    {{--  create advertisement banner show one title in this, one button with whatsapp font aowsome icone and button text is contect us --}}
    <div class="container mx-auto px-4">
        <div class="bg-blue-600 text-white p-4 mt-8 rounded flex items-center justify-between">
            <h2 class="text-xl font-semibold">ભજન શીખવા માટે ની તાલકીટ લેવા માટે સંપર્ક કરો... </h2>
            <a href="https://wa.me/919979047118" class="bg-green-500 text-white px-4 py-2 rounded flex items-center" target="_blank">
                <i class="fab fa-whatsapp"></i>
                <span class="ml-2">Contact Us</span>
            </a>
        </div>
    </div>

    {{-- this is a music website home page which contains some category vise  videos and blogs create home page HTML using tailwind-css, must be responsive --}}
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mt-8 mb-4">Latest Videos</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($latestVideos as $video)
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-xl font-semibold mb-2">{{ $video->title }}</h2>
                    <img src="{{ asset($video->thumbnail) }}" alt="video" class="w-full h-48 object-cover mb-2">
                    <p class="text-gray-600">{{ $video->description }}</p>
                    <a href="{{ route('videos.show', $video->slug) }}" class="block text-blue-600 mt-2">Watch Video</a>
                </div>
            @endforeach
        </div>

        @foreach($categories as $category)
            @if($category->videos->isEmpty())
                @continue
            @endif
            <h2 class="text-2xl font-semibold mt-8 mb-4">{{ $category->name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($category->videos as $video)
                    {{-- if loop count is 4 then add a advertisement banner in this position --}}
                    <div class="bg-white p-4 rounded shadow">
                        <h2 class="text-xl font-semibold mb-2">{{ $video->title }}</h2>
                        <img src="{{ asset($video->thumbnail) }}" alt="video" class="w-full h-48 object-cover mb-2">
                        <p class="text-gray-600">{{ $video->description }}</p>
                        <a href="{{ route('videos.show', $video->slug) }}" class="block text-blue-600 mt-2">Watch Video</a>
                    </div>
                @endforeach
            </div>
            @if($loop->iteration % 4  == 0)
                <div class="bg-blue-600 text-white p-4 my-5  rounded flex items-center justify-between">
                    <h2 class="text-xl font-semibold">ભજન શીખવા માટે ની તાલકીટ લેવા માટે સંપર્ક કરો... </h2>
                    <a href="https://wa.me/919979047118" class="bg-green-500 text-white px-4 py-2 rounded flex items-center" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        <span class="ml-2">Contact Us</span>
                    </a>
                </div>
            @endif
        @endforeach
    </div>

@endsection
