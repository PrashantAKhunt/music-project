@extends('admin.layouts.default')

@section('content')
    <h1 class="text-2xl font-semibold">Categories</h1>
    <div class="mt-5">
        <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white p-2 rounded">Add Category</a>
    </div>
    {{-- create Table  For Categories --}}
    <div class="mt-5">
        <table class="w-full border">
            <thead>
                <tr>
                    <th class="border">Index</th>
                    <th class="border">Name</th>
                    <th class="border">Description</th>
                    <th class="border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="border text-center">{{ $loop->index + 1 }}</td>
                        <td class="border">{{ $category->name }}</td>
                        <td class="border">{{ $category->description }}</td>
                        <td class="border">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="bg-blue-300 text-white p-1 rounded m-1"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white p-1 m-1 rounded"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>

@endsection
