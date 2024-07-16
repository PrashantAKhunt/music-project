@extends('admin.layouts.default')

@section('content')

    <h1 class="text-2xl font-semibold">Add Video</h1>
    <div class="mt-5">
        @if (session('error'))
            <p class="text-red-500">{{ session('error') }}</p>
        @endif
        {{-- display all validation errors --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <label for="title" class="block mb-2">Title</label>
                <input type="text" name="title" id="title" class="w-full p-2 border rounded" value="{{ old('title') }}">
                @error('title')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="description" class="block mb-2">Description</label>
                <textarea name="description" id="description" class="w-full p-2 border rounded">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="thumbnail_image" class="block mb-2">Thumbnail</label>
                <input type="file" name="thumbnail_image" id="thumbnail_image" class="w-full p-2 border rounded">
                @error('thumbnail_image')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            {{-- video URL --}}
            <div class="mb-5">
                <label for="video_url" class="block mb-2">Video URL</label>
                <input type="text" name="video_url" id="video_url" class="w-full p-2 border rounded" value="{{ old('video_url') }}">
                @error('video_url')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="category" class="block mb-2">Category</label>
                <select name="category_id" id="category" class="w-full p-2 border rounded">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <button type="submit" class="bg-blue-600 text-white p-2 rounded">Add Video</button>
            </div>
        </form>
    </div>

@endsection
