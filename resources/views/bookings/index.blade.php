@extends('layouts.app')
@php use \Carbon\Carbon; @endphp

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Bookings List</h1>

        <a href="{{ route('bookings.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Booking</a>

        @if (session('success'))
            <div class="mt-4 bg-green-200 text-green-800 p-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full mt-4 bg-white shadow rounded">
            <thead>
                <tr>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Facility</th>
                     <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Start Time</th>
                    <th class="px-4 py-2">End Time</th>
                    <th class="px-4 py-2">Status</th>
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
                            <a href="{{ route('bookings.edit', $bookings->id) }}" class="text-blue-600">Edit</a> |
                            <form action="{{ route('bookings.destroy', $bookings->id) }}" method="POST"
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
