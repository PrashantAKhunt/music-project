@extends('admin.layouts.default')

@section('content')
    <h1 class="text-2xl font-semibold">Add Lyrics</h1>

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

        <form action="{{ route('admin.lyrics.store') }}" method="POST" enctype="multipart/form-data">
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
                <textarea name="description" id="description" class="w-full p-2 border rounded">{!! old('description') !!}</textarea>
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
                <label for="content" class="block mb-2">Content</label>
                <textarea name="content" id="content" class="w-full p-2 border rounded txCkEditor" rows="10">{!! old('content') !!}</textarea>
                @error('content')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add Lyrics</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('.txCkEditor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo', 'imageUpload'],
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    
@endpush