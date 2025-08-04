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
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="session_date" id="session-date">
                        <input type="hidden" name="event_id" id="session-event-id">

                        {{-- 1) Sport Type --}}
                        <div class="mb-3">
                            <label for="session_sport_type" class="form-label">Sport Type</label>
                            <select name="session_sport_type" id="session_sport_type" class="form-select" required>
                                <option value="">Choose one…</option>
                                @foreach ($sportTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- 2) Coach (filtered) --}}
                        <div class="mb-3">
                            <label for="coach_id" class="form-label">Coach</label>
                            <select name="coach_id" id="coach_id" class="form-select" required>
                                <option value="">First pick a sport type</option>
                            </select>
                        </div>

                        {{-- 3) Times & Status --}}
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
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Create Session</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



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
                        <input type="hidden" name="event_id" id="booking-event-id">

                        {{-- 1) Sport Type --}}
                        <div class="mb-3">
                            <label for="sport_type_id" class="form-label">Sport Type</label>
                            <select name="sport_type_id" id="sport_type_id" class="form-select" required>
                                <option value="">Choose one…</option>
                                @foreach ($sportTypes as $type)
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

        document.addEventListener('DOMContentLoaded', () => {
            // --- Booking modal filter (already working) ---
            const allFacilities = @json($facilities);
            const allCoaches = @json($coaches);
            const sportSelect = document.getElementById('sport_type_id');
            const facilitySelect = document.getElementById('facility-select');
            const coachSelect = document.getElementById('coach-select');

            sportSelect.addEventListener('change', function() {
                const id = +this.value;
                facilitySelect.innerHTML = '<option>Choose facility…</option>';
                coachSelect.innerHTML = '<option>Choose coach…</option>';

                allFacilities.filter(f => f.sport_type_id === id)
                    .forEach(f => facilitySelect.append(new Option(f.name, f.id)));

                allCoaches.filter(c => c.sport_type_id === id)
                    .forEach(c => coachSelect.append(new Option(c.name, c.id)));
            });

            // --- Coaching session modal filter ---
            const sessSport = document.getElementById('session_sport_type');
            const sessCoach = document.getElementById('coach_id');

            sessSport.addEventListener('change', function() {
                const id = +this.value;
                sessCoach.innerHTML = '<option>Choose coach…</option>';
                allCoaches.filter(c => c.sport_type_id === id)
                    .forEach(c => sessCoach.append(new Option(c.name, c.id)));
            });

            // --- FullCalendar setup (unchanged) ---
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                /* your existing config… */
            });
            calendar.render();
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
                eventClick(info) {
                    const ev = info.event;

                    if (ev.title === 'Booking') {
                        // ---- Bookings ----
                        const sportSelect = document.getElementById('sport_type_id');
                        const facilitySel = document.getElementById('facility-select');
                        const coachSelect = document.getElementById('coach-select');
                        const form = document.getElementById('bookingForm');
                        const props = ev.extendedProps;

                        // 1) set Sport Type, then trigger your change‐listener to refill facility & coach
                        sportSelect.value = props.sport_type_id;
                        sportSelect.dispatchEvent(new Event('change'));

                        // 2) once your listener has populated facility & coach, select the right ones
                        facilitySel.value = props.facility_id;
                        coachSelect.value = props.coach_id;

                        // 3) other fields…
                        document.querySelector('#bookingModal input[name="date"]').value = ev.startStr
                            .slice(0, 10);
                        document.querySelector('#bookingModal select[name="start_time"]').value = ev
                            .startStr.slice(11, 16);
                        document.querySelector('#bookingModal select[name="end_time"]').value = ev.endStr
                            .slice(11, 16);
                        document.querySelector('#bookingModal select[name="status"]').value = props.status;
                        document.getElementById('booking-event-id').value = ev.id;
                        // 4) swap to edit / PATCH
                        //form.action = `/bookings/${ev.id}`;
                        //let m = form.querySelector('[name="_method"]');
                        //if (!m) {
                          // m = document.createElement('input');
                            //m.type = 'hidden';
                            //m.name = '_method';
                            //form.appendChild(m);
                        //}
                       // m.value = 'PATCH';
                       form.action = "{{ route('calendar.update') }}";
                       form.method = 'POST';            

                        new bootstrap.Modal(document.getElementById('bookingModal')).show();
                    } else {
                        // ---- Coaching Sessions ----
                        const sportSess = document.getElementById('session_sport_type');
                        const coachSess = document.getElementById('coach_id');
                        const form = document.getElementById('sessionForm');
                        const props = ev
                        .extendedProps; // make sure your controller sets this to 'session_sport_type'

                        // 1) set Sport Type, trigger your change‐listener to refill coach dropdown
                        sportSess.value = props.session_sport_type;
                        sportSess.dispatchEvent(new Event('change'));

                        // 2) select the right coach
                        coachSess.value = props.coach_id;

                        // 3) other fields…
                        document.querySelector('#sessionModal input[name="session_date"]').value = ev
                            .startStr.slice(0, 10);
                        document.querySelector('#sessionModal select[name="start_time"]').value = ev
                            .startStr.slice(11, 16);
                        document.querySelector('#sessionModal select[name="end_time"]').value = ev.endStr
                            .slice(11, 16);
                        document.querySelector('#sessionModal select[name="status"]').value = props.status;
                        document.getElementById('session-event-id').value = ev.id;
                        // 4) swap action to PATCH
                        // form.action = `/coachingsessions/${ev.id}`;
                        // let m = form.querySelector('[name="_method"]');
                        // if (!m) {
                        //     m = document.createElement('input');
                        //     m.type = 'hidden';
                        //     m.name = '_method';
                        //     form.appendChild(m);
                        // }
                        // m.value = 'PATCH';
                          form.action = "{{ route('calendar.update') }}";
                       form.method = 'POST';        

                        new bootstrap.Modal(document.getElementById('sessionModal')).show();
                    }
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
