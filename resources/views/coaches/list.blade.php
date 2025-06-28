@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Available Coaches</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($coaches as $coach)
            <div class="bg-white shadow rounded p-4">
                <h2 class="text-xl font-semibold">{{ $coach->name }}</h2>
                <p><strong>Specialization:</strong> {{ $coach->specialization }}</p>
                <p><strong>Contact:</strong> {{ $coach->contact_number }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
