<!-- resources/views/layouts/sidebar.blade.php -->
<aside class="w-64 bg-white border-r shadow-md hidden md:block">
    {{-- <div class="p-6 text-xl font-semibold">
        Court Booking
    </div> --}}
    <nav class="mt-6">
        <a href="{{ route('dashboard') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-200">Dashboard</a>
        <a href="{{ route('facilities.index') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-200">Facilities</a>
        <a href="{{ route('bookings.index') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-200">Bookings</a>
        <a href="{{ route('coaches.index') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-200">Coaches</a>
        <a href="{{ route('coachingsessions.index') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-200">Coaching Sessions</a>
        {{-- <a href="{{ route('payments.index') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-200">Payments</a> --}}
    </nav>
</aside>
