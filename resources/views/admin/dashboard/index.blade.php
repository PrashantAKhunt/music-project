@extends('admin.layouts.default')

@section('content')
    <h1 class="text-2xl font-semibold">Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-5">
        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-xl font-semibold">Total Categories</h2>
            <p class="text-3xl font-bold mt-2">{{ $totalCategories }}</p>
        </div>
        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-xl font-semibold">Total Videos</h2>
            <p class="text-3xl font-bold mt-2">{{ $totalVideos }}</p>
        </div>
        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-xl font-semibold">Total Bhajans Lyrics</h2>
            <p class="text-3xl font-bold mt-2">{{ $totalLyrics }}</p>
        </div>
    </div>
@endsection
