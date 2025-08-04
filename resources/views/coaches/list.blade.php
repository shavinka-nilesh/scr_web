@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Available Coaches</h1>

    {{-- 🔍 Search Form --}}
    <form method="GET" action="{{ route('coaches.list') }}" class="mb-6">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}"
            placeholder="Search by name or specialization..." 
            class="w-full p-3 border rounded shadow-sm focus:ring-2 focus:ring-blue-400"
        >
    </form>

    {{-- Coach Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($coaches as $coach)
            <div class="bg-white shadow rounded p-4">
                <h2 class="text-xl font-semibold">{{ $coach->name }}</h2>
                <p><strong>Specialization:</strong> {{ $coach->specialization }}</p>
                <p><strong>Contact:</strong> {{ $coach->contact_number }}</p>
            </div>
        @empty
            <p class="text-gray-500 col-span-full">No coaches found.</p>
        @endforelse
    </div>
</div>
@endsection
