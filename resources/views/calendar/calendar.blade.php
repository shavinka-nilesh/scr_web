@extends('layouts.app')

@section('content')
    <div class="container-fluid p-0">
        <h1 class="text-2xl font-bold mb-4 pt-4">Booking & Session Calendar</h1>
        <!-- Only show on mobile -->
        <div class="d-md-none mb-3 text-center">
            <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#bookingModal">Create Booking</button>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#sessionModal">Create Session</button>
        </div>

        <div id="calendarContainer" class="h-[calc(100vh-120px)] overflow-y-auto">
            <div id='calendar' class="h-full"></div>
        </div>
    </div>

    <!-- Choose Action Modal -->
    <div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Choose Booking Type</h5>
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
                        {{-- <div class="mb-3">
                            <label for="session_date" class="form-label">Select Date</label>
                            <input type="date" name="session_date" class="form-control">
                        </div> --}}
                        {{-- For desktop fallback --}}
                        {{-- <div class="mb-3">
    <label for="session_date" class="form-label">Select Date</label>
    <input type="date" name="session_date" id="session_date_fallback" class="form-control">
</div> --}}
                        @php
                            $start = strtotime('06:00');
                            $end = strtotime('22:00');
                        @endphp
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Start Time</label>
                            <select name="start_time" class="form-select" required>
                                @for ($i = $start; $i <= $end; $i += 1800)
                                    {{-- 1800 seconds = 30 minutes --}}
                                    @php $time = date('H:i', $i); @endphp
                                    <option value="{{ $time }}">{{ date('g:i A', $i) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="end_time" class="form-label">End Time</label>
                            <select name="end_time" class="form-select" required>
                                @for ($i = $start; $i <= $end; $i += 1800)
                                    @php $time = date('H:i', $i); @endphp
                                    <option value="{{ $time }}">{{ date('g:i A', $i) }}</option>
                                @endfor
                            </select>
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
    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="bookingForm" method="POST" action="{{ route('calendar.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Create Booking</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="date" id="booking-date">

                        {{-- 1) Sport Type --}}
                       <div class="mb-3">
  <label for="sport-type-select" class="form-label">Sport Type</label>
  <select id="sport-type-select" class="form-select" required>
    <option value="">Choose one…</option>
    @foreach($sportTypes as $type)
      <option value="{{ $type->id }}">{{ $type->name }}</option>
    @endforeach
  </select>
</div>

                        {{-- 2) Facility (filtered) --}}
                       <div class="mb-3">
  <label for="facility-select" class="form-label">Facility</label>
  <select name="facility_id" id="facility-select" class="form-select" required>
    <option value="">First pick a sport type</option>
  </select>
</div>
                        {{-- 3) Coach --}}
                        <!-- 3) Coach (filtered) -->
<div class="mb-3">
  <label for="coach-select" class="form-label">Coach</label>
  <select name="coach_id" id="coach-select" class="form-select" required>
    <option value="">First pick a sport type</option>
  </select>
</div>

                        {{-- 4) Times & status (unchanged) --}}
                        @php
                            $start = strtotime('06:00');
                            $end = strtotime('22:00');
                        @endphp

                        <div class="mb-3">
                            <label class="form-label">Start Time</label>
                            <select name="start_time" class="form-select" required>
                                @for ($i = $start; $i <= $end; $i += 1800)
                                    <option value="{{ date('H:i', $i) }}">{{ date('g:i A', $i) }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">End Time</label>
                            <select name="end_time" class="form-select" required>
                                @for ($i = $start; $i <= $end; $i += 1800)
                                    <option value="{{ date('H:i', $i) }}">{{ date('g:i A', $i) }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div><!-- /.modal-body -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.getElementById('sessionForm').addEventListener('submit', function() {
            const manualDate = document.getElementById('session_date_fallback').value;
            const hiddenInput = document.getElementById('session-date');
            if (!hiddenInput.value && manualDate) {
                hiddenInput.value = manualDate;
            }
        });
document.addEventListener('DOMContentLoaded', function() {
     const allFacilities = @json($facilities);
  const allCoaches    = @json($coaches);

  const sportSelect    = document.getElementById('sport-type-select');
  const facilitySelect = document.getElementById('facility-select');
  const coachSelect    = document.getElementById('coach-select');

  sportSelect.addEventListener('change', function() {
    const sportId = +this.value;              // numeric ID
    // reset dropdowns
    facilitySelect.innerHTML = '<option value="">Choose facility…</option>';
    coachSelect   .innerHTML = '<option value="">Choose coach…</option>';

    // repopulate facilities
    allFacilities
      .filter(f => f.sport_type_id === sportId)
      .forEach(f => {
        const o = document.createElement('option');
        o.value = f.id;
        o.text  = f.name;
        facilitySelect.appendChild(o);
      });

    // repopulate coaches
    allCoaches
      .filter(c => c.sport_type_id === sportId)
      .forEach(c => {
        const o = document.createElement('option');
        o.value = c.id;
        o.text  = c.name;
        coachSelect.appendChild(o);
      });
  });
  });
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.querySelector('input[name="date"]').value = today;
            document.querySelector('input[name="session_date"]').value = today;
        });
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth', // 👈 Mobile fallback
                windowResize: function(view) {
                    const newView = window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth';
                    if (calendar.view.type !== newView) {
                        calendar.changeView(newView);
                    }
                },
                height: '100%',
                selectable: true,
                select: function(info) {
                    // Set selected date
                    document.getElementById('booking-date').value = info.startStr;
                    document.getElementById('session-date').value = info.startStr;

                    // Show choice modal
                    const actionModal = new bootstrap.Modal(document.getElementById('actionModal'));
                    actionModal.show();

                    // When user selects action, show correct modal
                    document.getElementById('openBookingModal').onclick = function() {
                        actionModal.hide();
                        const bookingModal = new bootstrap.Modal(document.getElementById(
                            'bookingModal'));
                        bookingModal.show();
                    };

                    document.getElementById('openSessionModal').onclick = function() {
                        actionModal.hide();
                        const sessionModal = new bootstrap.Modal(document.getElementById(
                            'sessionModal'));
                        sessionModal.show();
                    };
                },
                events: "{{ route('calendar.events') }}",
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'long' // Ensures AM/PM is shown properly
                },
            });

            calendar.render();
        });
    </script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #calendarContainer {
            height: calc(100vh - 120px);
            /* adjust based on your header/footer height */
        }

        #calendar {
            height: 100% !important;
        }

        a {
            color: black !important;
            text-decoration: none;
        }

        .fc-event-title,
        .fc-event-time {
            color: black !important;
        }

        @media (max-width: 768px) {
            .fc-header-toolbar {
                flex-direction: column !important;
                align-items: stretch !important;
            }

            .fc-toolbar-chunk {
                display: flex;
                justify-content: space-between;
                margin-bottom: 0.5rem;
            }

            .fc-toolbar-chunk:nth-child(2) {
                /* center title */
                justify-content: center;
                order: -1;
                /* move title to top */
                margin-bottom: 1rem;
            }

            .fc-button {
                font-size: 0.85rem;
                padding: 0.25rem 0.5rem;
            }

            .fc-today-button {
                flex: 1;
                text-transform: capitalize !important;
            }
        }
    </style>
@endsection
