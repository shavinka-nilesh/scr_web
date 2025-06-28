@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 max-w-lg">
        <h1 class="text-2xl font-bold mb-6">Add New Facility</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('facilities.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <div class="mb-4">
                <label for="sport_type" class="block font-semibold mb-2">Sport Type</label>
                <select name="sport_type" id="sport_type" class="form-select w-full px-3 py-2 border rounded">
                    @foreach ($SportType as $coach)
                        <option value="{{ $coach->name }}">{{ $coach->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="contact_number" class="block text-gray-700 font-semibold mb-2">Capacity</label>
                <input type="text" name="capacity" id="capacity" value="{{ old('capacity') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>
            <div class="mb-4">
                <label for="contact_number" class="block text-gray-700 font-semibold mb-2">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>
            <div class="mb-4">
                <label for="contact_number" class="block text-gray-700 font-semibold mb-2">Description</label>
                <input type="text" name="description" id="description" value="{{ old('description') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>
            <div id="preview" class="flex gap-2 mt-2"></div>
            <div class="mb-4">
                <label for="images" class="block font-semibold mb-2">Upload Images (max 4)</label>
                <input type="file" name="images[]" multiple accept="image/*"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    onchange="if(this.files.length > 4){ alert('Only up to 4 images allowed'); this.value=''; }">
            </div>
            <div class="flex justify-between">
                <a href="{{ route('facilities.index') }}"
                    class="bg-gray-400 text-black px-4 py-2 rounded hover:bg-gray-500">Cancel</a>
                <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">Add Coach</button>
            </div>
        </form>
    </div>
@endsection
<script>
    console.log("Form old values:", {
        name: @json(old('name')),
        sport_type: @json(old('sport_type')),
        capacity: @json(old('capacity')),
        location: @json(old('location')),
        description: @json(old('description')),
    });

    document.querySelector('input[name="images[]"]').addEventListener('change', function(e) {
    const preview = document.getElementById('preview');
    preview.innerHTML = ''; // clear old previews
    Array.from(e.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = "w-20 h-20 object-cover rounded";
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});
</script>
