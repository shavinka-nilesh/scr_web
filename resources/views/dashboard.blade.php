<x-app-layout>
    {{-- ✅ Just the page title in the header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
         {{-- ✅ Actual content goes here --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <a href="{{ route('coaches.index') }}" class="block bg-white shadow p-4 rounded text-center hover:bg-blue-50 transition">
                        <h2 class="text-lg font-semibold">Coaches</h2>
                        <p class="text-3xl font-bold text-blue-600">{{ $coachCount }}</p>
                    </a>
                    <!-- Add other tiles here... -->
                </div>

                <div class="bg-white p-4 mt-4 rounded shadow">
                    <h3 class="text-lg font-semibold mb-2">Booking Trends</h3>
                    <canvas id="bookingChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('bookingChart').getContext('2d');
        const bookingChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($dates),
                datasets: [{
                    label: 'Bookings',
                    data: @json($counts),
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    </x-slot>

   
</x-app-layout>
