@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Sports</h1>

    <a href="{{ route('sport_types.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Sport</a>

    @if(session('success'))
        <div class="mt-4 bg-green-200 text-green-800 p-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full mt-4 bg-white shadow rounded">
        <thead>
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Description</th>
                {{-- <th class="px-4 py-2">Status</th> --}}
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($SportType as $coach)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $coach->name }}</td>
                <td class="px-4 py-2">{{ $coach->description }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('sport_types.edit', $coach->id) }}" class="text-blue-600">Edit</a> |
                    <form action="{{ route('sport_types.destroy', $coach->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
