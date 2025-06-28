@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 max-w-lg">
        {{-- <h1 class="text-2xl font-bold mb-6">Edit Bookings</h1> --}}

        <div class="container py-4">
            <h1 class="text-xl font-bold mb-4">Booking Calendar</h1>
            <div id='calendar'></div>
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- Offcanvas --}}
        <div class="offcanvas offcanvas-end" tabindex="-1" id="bookingPanel" aria-labelledby="bookingPanelLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="bookingPanelLabel">Create Bookings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="date" id="booking_date">
                    <div class="mb-3">
                        <label>Start Time</label>
                        <input type="time" name="start_time" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>End Time</label>
                        <input type="time" name="end_time" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Facility</label>
                        <select name="facility_id" class="form-select">
                            @foreach ($facilities as $facility)
                                <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Book</button>
                </form>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                    initialView: 'dayGridMonth',
                    dateClick: function(info) {
                        // set date in form
                        document.getElementById('booking_date').value = info.dateStr;
                        // show offcanvas
                        let offcanvas = new bootstrap.Offcanvas(document.getElementById('bookingPanel'));
                        offcanvas.show();
                    },
                    events: '/api/bookings' // you can use route('api.bookings') if you define one
                });
                calendar.render();
            });
        </script>
    @endpush
</div>
@endsection
