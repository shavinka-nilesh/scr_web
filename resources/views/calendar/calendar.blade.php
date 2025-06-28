@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Booking & Session Calendar</h1>
    <div id='calendar'></div>
</div>

<!-- Choose Action Modal -->
<div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choose Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <button id="openBookingModal" class="btn btn-primary mb-2 w-100">Create Booking</button>
                <button id="openSessionModal" class="btn btn-secondary w-100">Create Coaching Session</button>
            </div>
        </div>
    </div>
</div>

<!-- Coaching Session Modal -->
<div class="modal fade" id="sessionModal" tabindex="-1" aria-labelledby="sessionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="sessionForm" method="POST" action="{{ route('calendar.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create Coaching Session</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="session_date" id="session-date">

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
                    <button type="submit" class="btn btn-success">Create Session</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Bookking Modal -->
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
            // Set selected date
            document.getElementById('booking-date').value = info.startStr;
            document.getElementById('session-date').value = info.startStr;

            // Show choice modal
            const actionModal = new bootstrap.Modal(document.getElementById('actionModal'));
            actionModal.show();

            // When user selects action, show correct modal
            document.getElementById('openBookingModal').onclick = function () {
                actionModal.hide();
                const bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
                bookingModal.show();
            };

            document.getElementById('openSessionModal').onclick = function () {
                actionModal.hide();
                const sessionModal = new bootstrap.Modal(document.getElementById('sessionModal'));
                sessionModal.show();
            };
        },
        events: "{{ route('calendar.events') }}",
    });

    calendar.render();
});
</script>

@endsection
