<form id="bookingForm" method="POST" action="{{ route('bookings.store') }}">
    @csrf
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

    <button type="submit" class="btn btn-primary">Create Bookings</button>
</form>
