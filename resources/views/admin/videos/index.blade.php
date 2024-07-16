@extends('admin.layouts.default')

@section('content')

    <h1 class="text-2xl font-semibold">Videos</h1>
    <div class="mt-5">
        <a href="{{ route('admin.videos.create') }}" class="bg-blue-600 text-white p-2 rounded">Add Video</a>
    </div>
    {{-- create Table  For Videos --}}
    <div class="mt-5">
        <table class="w-full border">
            <thead>
                <tr>
                    <th class="border">Index</th>
                    <th class="border">Thumbnail</th>
                    <th class="border">Title</th>
                    <th class="border">Description</th>
                    <th class="border">Category</th>
                    <th class="border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videos as $video)
                    <tr>
                        <td class="border text-center">{{ $loop->index + 1 }}</td>
                        <td class="border">
                            <img src="{{ asset($video->thumbnail) }}" alt="{{ $video->title }}" class="w-20 h-20 object-cover">
                        </td>
                        <td class="border">{{ $video->title }}</td>
                        <td class="border">{{ $video->description }}</td>
                        <td class="border">{{ $video->category->name }}</td>
                        <td class="border">
                            <a href="{{ route('admin.videos.edit', $video->id) }}" class="bg-blue-300 text-white p-1 rounded m-1"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white p-1 m-1 rounded"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $videos->links() }}
    </div>
@endsection
