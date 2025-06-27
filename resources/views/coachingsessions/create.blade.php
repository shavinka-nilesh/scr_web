@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-6">Add New Coaching Session</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('coachingsessions.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        {{-- User Dropdown --}}
        <div class="mb-4">
            <label for="user_id" class="block font-semibold mb-2">Customer</label>
            <select name="user_id" id="user_id" class="form-select w-full px-3 py-2 border rounded">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        {{-- Coach Dropdown --}}
        <div class="mb-4">
            <label for="coach_id" class="block font-semibold mb-2">Coach</label>
            <select name="coach_id" id="coach_id" class="form-select w-full px-3 py-2 border rounded">
                @foreach($coaches as $coach)
                    <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Date Picker --}}
        <div class="mb-4">
            <label for="session_date" class="block font-semibold mb-2">Date</label>
            <input type="date" name="session_date" id="session_date" class="form-control w-full px-3 py-2 border rounded"
                value="{{ old('session_date') }}" required>
        </div>

        {{-- Start Time Picker --}}
        <div class="mb-4">
            <label for="start_time" class="block font-semibold mb-2">Start Time</label>
            <input type="time" name="start_time" id="start_time" class="form-control w-full px-3 py-2 border rounded"
                value="{{ old('start_time') }}" required>
        </div>

        {{-- End Time Picker --}}
        <div class="mb-4">
            <label for="end_time" class="block font-semibold mb-2">End Time</label>
            <input type="time" name="end_time" id="end_time" class="form-control w-full px-3 py-2 border rounded"
                value="{{ old('end_time') }}" required>
        </div>

        {{-- Status Dropdown --}}
        <div class="mb-4">
            <label for="status" class="block font-semibold mb-2">Status</label>
            <select name="status" id="status" class="form-select w-full px-3 py-2 border rounded">
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('coachingsessions.index') }}" class="bg-gray-400 text-black px-4 py-2 rounded hover:bg-gray-500">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Session</button>
        </div>
    </form>
</div>
@endsection
