@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-6">Add New Coach</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('coaches.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>

        <div class="mb-4">
            <label for="specialization" class="block text-gray-700 font-semibold mb-2">Specialization</label>
            <input type="text" name="specialization" id="specialization" value="{{ old('specialization') }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>

        <div class="mb-4">
            <label for="contact_number" class="block text-gray-700 font-semibold mb-2">Contact Number</label>
            <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number') }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>

        <div class="flex justify-between">
            <a href="{{ route('coaches.index') }}" class="bg-gray-400 text-black px-4 py-2 rounded hover:bg-gray-500">Cancel</a>
            <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">Add Coach</button>
        </div>
    </form>
</div>
@endsection
