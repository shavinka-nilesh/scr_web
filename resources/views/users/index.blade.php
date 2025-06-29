@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Users List</h1>

        <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New User</a>

        @if (session('success'))
            <div class="mt-4 bg-green-200 text-green-800 p-2 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mt-4 bg-red-200 text-red-800 p-2 rounded">
                {{ session('error') }}
            </div>
        @endif
        <table class="table-auto w-full mt-4 bg-white shadow rounded">
            <thead>
                <tr>
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">email</th>
                    <th class="px-4 py-2">Phone Number</th>
                    <th class="px-4 py-2">Address</th>
                          <th class="px-4 py-2">Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($User as $facility)
                    <tr class="border-t">
                        <td class="px-4 py-2">
                            {{-- @forelse($facility->images as $image)
                                <img src="{{ asset('storage/' . $image->path) }}" class="h-20 w-20 object-cover rounded" />
                            @empty
                                <span class="text-gray-500">No image</span>
                            @endforelse --}}
                            {{-- @if ($facility->images->first())
                                <img src="{{ asset('storage/' . $facility->images->first()->path) }}"
                                    class="h-20 w-20 object-cover rounded" />
                            @else
                                <span class="text-gray-500">No image</span>
                            @endif --}}

                        </td>
                        <td class="px-4 py-2">{{ $facility->name }}</td>
                        <td class="px-4 py-2">{{ $facility->email }}</td>
                        <td class="px-4 py-2">{{ $facility->phone_number }}</td>
                        <td class="px-4 py-2">{{ $facility->address }}</td>
                        <td class="px-4 py-2">{{ $facility->role }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('users.edit', $facility->id) }}" class="text-blue-600">Edit</a> |
                            <form action="{{ route('users.destroy', $facility->id) }}" method="POST"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')"
                                    class="text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
