@extends('layouts.app')
@php use \Carbon\Carbon; @endphp

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Bookings List</h1>

        <a href="{{ route('bookings.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded"><i class="fa fa-plus me-2" aria-hidden="true"></i>Add New Booking</a>

        @if (session('success'))
            <div class="mt-4 bg-green-200 text-green-800 p-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="hidden md:block table-auto w-full mt-4 bg-white shadow rounded">
            <thead>
                <tr>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Facility</th>
                     <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Start Time</th>
                    <th class="px-4 py-2">End Time</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Booking as $bookings)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $bookings->user->name ?? 'N/A' }}</td>
                         <td class="px-4 py-2">{{ $bookings->facility->name ?? 'N/A' }}</td>
                        <td>{{ Carbon::parse($bookings->date)->format('Y-m-d') }}</td>
                        <td>{{ Carbon::parse($bookings->start_time)->format('h:i A') }}</td>
                        <td>{{ Carbon::parse($bookings->end_time)->format('h:i A') }}</td>
                        <td class="px-4 py-2">{{ $bookings->status }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('bookings.edit', $bookings->id) }}" class="text-primary"><i class="fas fa-edit me-2"></i>Edit</a> |
                            <form action="{{ route('bookings.destroy', $bookings->id) }}" method="POST"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')"
                                    class="text-red-600"><i class="fas fa-trash-alt me-2"></i>Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="block md:hidden overflow-x-auto">
            {{-- second: “card-style” table only on small screens --}}
            <div class="mt-4 block md:hidden">
                @foreach ($Booking as $f)
                    <div class="bg-white shadow rounded border p-4 mb-4">
                        {{-- <div class="flex items-start mb-2"> --}}
                            {{-- @if ($f->images->first())
                                <img src="{{ asset('storage/' . $f->images->first()->path) }}"
                                    class="h-16 w-16 object-cover rounded mr-4" />
                            @endif --}}
                            {{-- <div>
                                <h2 class="font-semibold">{{ $f->name }}</h2>
                                <p class="text-sm"><strong>Sport:</strong> {{ $f->sport_type }}</p>
                            </div> --}}
                        {{-- </div> --}}
                        <p><strong>User:</strong> {{ $f->user->name ?? 'N/A' }}</p>
                        <p><strong>Facility:</strong> {{ $f->facility->name ?? 'N/A' }}</p>
                        <p><strong>Date:</strong>{{ Carbon::parse($f->date)->format('Y-m-d') }}</p>
                        <p><strong>Start Time:</strong> {{ Carbon::parse($f->start_time)->format('h:i A') }}</p>
                        <p><strong>End Time:</strong> {{ Carbon::parse($f->end_time)->format('h:i A') }}</p>
                          <p><strong>Status:</strong> {{ $f->status }}</p>
                        <div class="mt-3 flex flex justify-between items-center w-full">
                            <a href="{{ route('users.edit', $f->id) }}" class="text-primary"><i
                                    class="fas fa-edit me-2"></i>Edit</a>
                            <form action="{{ route('users.destroy', $f->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Delete this facility?')"
                                    class="text-red-600"><i
                                        class="fas fa-trash-alt me-2"></i>Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            </table>
        </div>
    </div>
@endsection
