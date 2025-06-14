@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Coaches List</h1>

    <a href="{{ route('coaches.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Coach</a>

    @if(session('success'))
        <div class="mt-4 bg-green-200 text-green-800 p-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full mt-4 bg-white shadow rounded">
        <thead>
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Specialization</th>
                <th class="px-4 py-2">Contact</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coaches as $coach)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $coach->name }}</td>
                <td class="px-4 py-2">{{ $coach->specialization }}</td>
                <td class="px-4 py-2">{{ $coach->contact_number }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('coaches.edit', $coach->id) }}" class="text-blue-600">Edit</a> |
                    <form action="{{ route('coaches.destroy', $coach->id) }}" method="POST" class="inline-block">
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
