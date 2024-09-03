@extends('admin.layouts.default')

@section('content')

    <h1 class="text-2xl font-semibold">Bhajan Lyrics</h1>
    <div class="mt-5">
        <a href="{{ route('admin.lyrics.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded inline-block">Add New Lyrics</a>
    </div>

    <div class="mt-5">
        <table class="w-full border">
            <thead>
                <tr>
                    <th class="border">Index</th>
                    <th class="border">Thumbnail</th>
                    <th class="border">Title</th>
                    <th class="border">Category</th>
                    <th class="border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lyrics as $lyric)
                    <tr>
                        <td class="border text-center">{{ $loop->index + 1 }}</td>
                        <td class="border">
                            <img src="{{ asset($lyric->thumbnail) }}" alt="{{ $lyric->title }}" class="w-20 h-20 object-cover">
                        </td>
                        <td class="border">{{ $lyric->title }}</td>
                        <td class="border">{{ $lyric->category->name }}</td>
                        <td class="border">
                            <a href="{{ route('admin.lyrics.edit', $lyric->id) }}" class="bg-blue-300 text-white p-1 rounded m-1"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.lyrics.destroy', $lyric->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white p-1 m-1 rounded"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $lyrics->links() }}
    </div>
@endsection
