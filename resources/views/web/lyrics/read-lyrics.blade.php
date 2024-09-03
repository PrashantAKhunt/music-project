@extends('web.layouts.default')

@section('content')

<div class="container mx-auto p-4">
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
            {{-- Lyrics Section --}}
            <div class="md:col-span-9">
                <h2 class="text-2xl font-semibold mt-4">{{ $lyric->title }}</h2>
                <p class="text-gray-600">{!! $lyric->description !!}</p>
                <img src="{{ asset($lyric->thumbnail) }}" alt="{{ $lyric->title }}" class="w-50 h-50 object-cover mt-4">
                <div class="mt-4">
                    {!! $lyric->content !!}
                </div>
            </div>
            {{-- Related Lyrics Section --}}

            <div class="md:col-span-3 space-y-4">
                @foreach($relatedLyrics as $relatedLyric)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <img src="{{ asset($relatedLyric->thumbnail) }}" alt="Lyric Thumbnail" class="w-full rounded">
                        <h2 class="text-lg font-semibold mt-2">{{ $relatedLyric->title }}</h2>
                        <p class="text-gray-600">{{ $relatedLyric->description }}</p>
                        <a href="{{ route('lyrics.show', $relatedLyric->slug) }}" class="bg-blue-600 text-white px-2 py-1 rounded mt-2 inline-block">Read Lyrics</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection


                