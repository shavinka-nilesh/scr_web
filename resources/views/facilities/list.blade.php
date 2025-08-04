@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Browse Facilities</h1>

    {{-- 🔍 Search bar --}}
    <form method="GET" action="{{ route('facilities.list') }}" class="mb-6">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}"
            placeholder="Search by facility name or sport type..." 
            class="w-full p-3 border rounded shadow-sm focus:ring-2 focus:ring-blue-400"
        >
    </form>

    {{-- Facilities Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($facilities as $facility)
            <div class="bg-white shadow rounded overflow-hidden">
                {{-- Image Gallery (first 3 only) --}}
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
    </div>
</div>
@endsection
