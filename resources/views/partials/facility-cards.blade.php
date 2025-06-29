@forelse($facilities as $facility)
    <div class="bg-white shadow rounded overflow-hidden">
        @if($facility->images->count())
            <div class="grid grid-cols-3 gap-1">
                @foreach($facility->images->take(3) as $image)
                    <img 
                        src="{{ asset('storage/' . $image->path) }}" 
                        alt="Facility Image" 
                        class="object-cover h-32 w-full"
                    >
                @endforeach
            </div>
        @endif

        <div class="p-4">
            <h2 class="text-lg font-bold">{{ $facility->name }}</h2>
            <p class="text-sm text-gray-600 mb-1"><strong>Sport:</strong> {{ $facility->sport_type }}</p>
            <p class="text-sm text-gray-600 mb-1"><strong>Location:</strong> {{ $facility->location }}</p>
            <p class="text-sm text-gray-600"><strong>Capacity:</strong> {{ $facility->capacity }}</p>
            <p class="mt-2 text-gray-700">{{ $facility->description }}</p>
        </div>
    </div>
@empty
    <p class="text-gray-500 col-span-full">No facilities found.</p>
@endforelse
