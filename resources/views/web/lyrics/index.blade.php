@extends('web.layouts.default')

@section('content')

<div class="container mx-auto p-4">
    <div class="md:flex">
        <!-- Mobile Sidebar Toggle Button -->
        <button id="sidebar-toggle" class="md:hidden px-4 py-2 bg-blue-600 text-white rounded-lg mb-4">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Sidebar (Collapsible on mobile) -->
        <div id="sidebar" class="md:w-1/4 w-full md:block hidden md:relative fixed inset-0 bg-white p-4 mr-2 rounded-lg shadow-md md:shadow-none md:static z-10">
            <div class="mb-4">
                <h2 class="text-lg font-semibold">Search Lyrics</h2>
                <form action="{{ route('lyrics.index') }}" method="GET">
                    <input type="text" name="search" class="w-full border border-gray-300 rounded p-2 mt-2" placeholder="Search Lyrics" value="{{ request()->get('search') }}">
                    <button type="submit" class="bg-blue-600 text-white px-2 py-1 rounded mt-2">Search</button>
                </form>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Categories</h2>
                <ul class="mt-2">
                    <li><a href="{{ route('lyrics.index') }}" class="block hover:underline" @if(!request()->has('category')) style="font-weight: bold;" @endif>All Lyrics</a></li>
                    @foreach($allCategories as $category)
                        <li><a href="{{ route('lyrics.index', ['category' => $category->id]) }}" class="block hover:underline" @if(request()->get('category') == $category->id) style="font-weight: bold;" @endif>{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Videos Section -->
        <div class="md:w-3/4 w-full">
            @if(request()->has('category'))
                <div class="bg-white p-4 rounded-lg shadow-md mb-2">
                    <h2 class="text-lg font-semibold">Category: {{ $categoryName }}</h2>
                </div>
            @elseif(request()->has('search') && request()->get('search') != '')
                <div class="bg-white p-4 rounded-lg shadow-md mb-2">
                    <h2 class="text-lg font-semibold">Search: {{ request()->get('search') }} ...</h2>
                </div>
            @else
                <div class="bg-white p-4 rounded-lg shadow-md mb-2">
                    <h2 class="text-lg font-semibold">All Lyrics</h2>
                </div>
            @endif

            @if($lyrics->count() == 0)
                <div class="bg-white p-4 rounded-lg shadow-md mb-2">
                    <h2 class="text-lg font-semibold">No Lyrics Found</h2>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($lyrics as $lyric)
                        <div class="bg-white p-4 rounded-lg shadow-md">
                            <img src="{{ asset($lyric->thumbnail) }}" alt="Lyric Thumbnail" class="w-full rounded">
                            <h2 class="text-lg font-semibold mt-2">{{ $lyric->title }}</h2>
                            <p class="text-gray-600">{{ $lyric->description }}</p>
                            <a href="{{ route('lyrics.show', $lyric->slug) }}" class="bg-blue-600 text-white px-2 py-1 rounded mt-2 inline-block">Read Lyrics</a>
                        </div>
                    @endforeach

                </div>

                <div class="mt-4">
                    {{ $lyrics->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.getElementById('sidebar-toggle').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
    });
</script>

@endsection