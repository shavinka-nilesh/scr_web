@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Booking & Session Calendar</h1>
    <div id='calendar'></div>
</div>
<!-- Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="bookingForm" method="POST" action="{{ route('calendar.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Create Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="date" id="booking-date">

                    <div class="mb-3">
                        <label for="facility_id" class="form-label">Facility</label>
                        <select name="facility_id" class="form-select" required>
                            @foreach ($facilities as $facility)
                                <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="coach_id" class="form-label">Coach</label>
                        <select name="coach_id" class="form-select" required>
                            @foreach ($coaches as $coach)
                                <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" name="start_time" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" name="end_time" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        select: function (info) {
            // Set selected date into the form
            document.getElementById('booking-date').value = info.startStr;

            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('bookingModal'));
            modal.show();
        },
        events: "{{ route('calendar.events') }}",
    });

    calendar.render();
});

</script>

@endsection
