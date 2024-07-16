@extends('admin.layouts.default')

@section('content')

    <h1 class="text-2xl font-semibold">Edit Category</h1>
    <div class="mt-5">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-lg font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $category->name }}" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ $category->description }}</textarea>
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-600 text-white p-2 rounded">Update Category</button>
            </div>
        </form>
    </div>

@endsection
