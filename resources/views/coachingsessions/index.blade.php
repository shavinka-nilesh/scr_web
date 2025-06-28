@extends('layouts.app')
@php use \Carbon\Carbon; @endphp

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Coaching Session List</h1>

        <a href="{{ route('coachingsessions.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Coaching
            Session</a>

        @if (session('success'))
            <div class="mt-4 bg-green-200 text-green-800 p-2 rounded">
                {{ session('success') }}
            </div>
        @endif


        <table class="table-auto w-full mt-4 bg-white shadow rounded">
            <thead>
                <tr>
                    <th class="px-4 py-2">Session Id</th>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Coach</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Start Time</th>
                    <th class="px-4 py-2">End Time</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coachingSessions as $session)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $session->id }}</td>
                        <td class="px-4 py-2">{{ $session->user->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $session->coach->name ?? 'N/A' }}</td>
                        <td>{{ Carbon::parse($session->session_date)->format('Y-m-d') }}</td>
                        <td>{{ Carbon::parse($session->start_time)->format('h:i A') }}</td>
                        <td>{{ Carbon::parse($session->end_time)->format('h:i A') }}</td>
                        <td class="px-4 py-2">{{ $session->status }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('coachingsessions.edit', $session->id) }}" class="text-blue-600">Edit</a> |
                            <form action="{{ route('coachingsessions.destroy', $session->id) }}" method="POST"
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
