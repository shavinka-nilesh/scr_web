@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Booking & Session Calendar</h1>
    <div id='calendar'></div>
</div>
<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="bookingOffcanvas" aria-labelledby="bookingOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 id="bookingOffcanvasLabel">Create Booking</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @include('bookings._form', ['facilities' => $facilities])
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        events: '{{ route('calendar.events') }}',
        select: function (info) {
            // Set date in hidden input
            document.getElementById('booking-date').value = info.startStr;

            // Show offcanvas
            const offcanvas = new bootstrap.Offcanvas(document.getElementById('bookingOffcanvas'));
            offcanvas.show();
        }
    });

    calendar.render();
});
</script>

@endsection
