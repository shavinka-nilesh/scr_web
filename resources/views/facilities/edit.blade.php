@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-6">Edit Facility</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $facility->name) }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>


         <div class="mb-4">
                <label for="sport_type" class="block font-semibold mb-2">Sport Type</label>
                <select name="sport_type" id="sport_type" class="form-select w-full px-3 py-2 border rounded">
                    @foreach ($SportType as $coach)
                        <option value="{{ $coach->name }}"
                            {{ old('sport_type', $facility->sport_type) == $coach->name ? 'selected' : '' }}>
                            {{ $coach->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        <div class="mb-4">
            <label for="contact_number" class="block text-gray-700 font-semibold mb-2">Capacity</label>
            <input type="text" name="capacity" id="capacity" value="{{ old('capacity', $facility->capacity) }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>

          <div class="mb-4">
            <label for="contact_number" class="block text-gray-700 font-semibold mb-2">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location', $facility->location) }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>

          <div class="mb-4">
            <label for="contact_number" class="block text-gray-700 font-semibold mb-2">Description</label>
            <input type="text" name="description" id="description" value="{{ old('description', $facility->description) }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>
<div class="mb-4">
    <label class="block text-gray-700 font-semibold mb-2">Existing Images</label>
    <div class="flex flex-wrap gap-4">
        @forelse($facility->images as $image)
            <div class="relative w-24 h-24">
                <img src="{{ asset('storage/' . $image->path) }}" class="object-cover w-full h-full rounded border" alt="Facility Image">
            </div>
        @empty
            <p class="text-gray-500">No images uploaded.</p>
        @endforelse
    </div>
</div>
<div class="mb-4">
    <label for="images" class="block text-gray-700 font-semibold mb-2">Upload New Images</label>
    <input type="file" name="images[]" id="images" accept="image/*" multiple
        class="w-full border border-gray-300 rounded px-3 py-2" />
</div>

        <div class="flex justify-between">
            <a href="{{ route('facilities.index') }}" class="bg-gray-400 text-black px-4 py-2 rounded hover:bg-gray-500">Cancel</a>
            <button type="submit" class="bg-green-600 text-black px-4 py-2 rounded hover:bg-green-700">Update Coach</button>
        </div>
    </form>
</div>
@endsection
