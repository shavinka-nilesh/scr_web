@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 max-w-lg">
        <h1 class="text-2xl font-bold mb-6">Edit Bookings</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bookings.update', $Bookings->id) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            {{-- User Dropdown --}}
            <div class="mb-4">
                <label for="user_id" class="block font-semibold mb-2">Customer</label>
                <select name="user_id" id="user_id" class="form-select w-full px-3 py-2 border rounded">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ old('user_id', $Bookings->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Facility Dropdown --}}
            <div class="mb-4">
                <label for="facility_id" class="block font-semibold mb-2">Facility</label>
                <select name="facility_id" id="facility_id" class="form-select w-full px-3 py-2 border rounded">
                    @foreach ($facilities as $facility)
                        <option value="{{ $facility->id }}"
                            {{ old('facility_id', $Bookings->facility_id) == $facility->id ? 'selected' : '' }}>
                            {{ $facility->name }} ({{ $facility->sport_type }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Date Picker --}}
            <div class="mb-4">
                <label for="date" class="block font-semibold mb-2">Date</label>
                <input type="date" name="date" id="date" class="form-control w-full px-3 py-2 border rounded"
                    value="{{ old('date', \Carbon\Carbon::parse($Bookings->date)->format('Y-m-d')) }}" required>
            </div>

            {{-- Start Time Picker --}}
            <div class="mb-4">
                <label for="start_time" class="block font-semibold mb-2">Start Time</label>
                <input type="time" name="start_time" id="start_time" class="form-control w-full px-3 py-2 border rounded"
                    value="{{ old('start_time', $Bookings->start_time) }}" required>
            </div>

            {{-- End Time Picker --}}
            <div class="mb-4">
                <label for="end_time" class="block font-semibold mb-2">End Time</label>
                <input type="time" name="end_time" id="end_time" class="form-control w-full px-3 py-2 border rounded"
                    value="{{ old('end_time', $Bookings->end_time) }}" required>
            </div>

            {{-- Status Dropdown --}}
            <div class="mb-4">
                <label for="status" class="block font-semibold mb-2">Status</label>
                @php
                    $status = old('status', $Bookings->status);
                @endphp
                <select name="status" id="status" class="form-select w-full px-3 py-2 border rounded">
                    <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('coachingsessions.index') }}"
                    class="bg-gray-400 text-black px-4 py-2 rounded hover:bg-gray-500">Cancel</a>
                <button type="submit" class="bg-green-600 text-black px-4 py-2 rounded hover:bg-green-700">Update
                </button>
            </div>
        </form>
    </div>
@endsection
