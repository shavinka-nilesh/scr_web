@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-6">Edit Booking</h1>

    @if ($errors->any())
      <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('bookings.update', $Bookings->id) }}" method="POST"
          class="bg-white p-6 rounded shadow">
      @csrf
      @method('PUT')

      {{-- Customer --}}
      <div class="mb-4">
        <label for="user_id" class="block font-semibold mb-2">Customer</label>
        <select name="user_id" id="user_id"
                class="form-select w-full px-3 py-2 border rounded">
          @foreach($users as $user)
            <option value="{{ $user->id }}"
              {{ old('user_id', $Bookings->user_id) == $user->id ? 'selected' : '' }}>
              {{ $user->name }} ({{ $user->email }})
            </option>
          @endforeach
        </select>
      </div>

      {{-- 1) Sport Type --}}
      <div class="mb-4">
        <label for="sport_type_id" class="block font-semibold mb-2">Sport Type</label>
        <select name="sport_type_id" id="sport_type_id"
                class="form-select w-full px-3 py-2 border rounded" required>
          <option value="">Choose one…</option>
          @foreach($SportType as $type)
            <option value="{{ $type->id }}"
              {{ old('sport_type_id', $Bookings->sport_type_id) == $type->id ? 'selected' : '' }}>
              {{ $type->name }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- 2) Facility --}}
      <div class="mb-4">
        <label for="facility_id" class="block font-semibold mb-2">Facility</label>
        <select name="facility_id" id="facility_id"
                class="form-select w-full px-3 py-2 border rounded" required>
          {{-- options will be injected by JS --}}
        </select>
      </div>

      {{-- 3) Coach --}}
      <div class="mb-4">
        <label for="coach_id" class="block font-semibold mb-2">Coach</label>
        <select name="coach_id" id="coach_id"
                class="form-select w-full px-3 py-2 border rounded" required>
          {{-- options will be injected by JS --}}
        </select>
      </div>

      {{-- Date, Times, Status --}}
      <div class="mb-4">
        <label for="date" class="block font-semibold mb-2">Date</label>
        <input type="date" name="date" id="date"
          class="form-control w-full px-3 py-2 border rounded"
          value="{{ old('date', $Bookings->date->format('Y-m-d')) }}" required>
      </div>
      <div class="mb-4">
        <label for="start_time" class="block font-semibold mb-2">Start Time</label>
        <input type="time" name="start_time" id="start_time"
          class="form-control w-full px-3 py-2 border rounded"
          value="{{ old('start_time', $Bookings->start_time) }}" required>
      </div>
      <div class="mb-4">
        <label for="end_time" class="block font-semibold mb-2">End Time</label>
        <input type="time" name="end_time" id="end_time"
          class="form-control w-full px-3 py-2 border rounded"
          value="{{ old('end_time', $Bookings->end_time) }}" required>
      </div>
      <div class="mb-4">
        <label for="status" class="block font-semibold mb-2">Status</label>
        <select name="status" id="status"
                class="form-select w-full px-3 py-2 border rounded">
          @php $st = old('status', $Bookings->status); @endphp
          <option value="pending"   {{ $st=='pending'   ? 'selected':'' }}>Pending</option>
          <option value="confirmed" {{ $st=='confirmed' ? 'selected':'' }}>Confirmed</option>
          <option value="cancelled" {{ $st=='cancelled' ? 'selected':'' }}>Cancelled</option>
        </select>
      </div>

      <div class="flex justify-between">
        <a href="{{ route('bookings.index') }}"
           class="bg-gray-400 text-black px-4 py-2 rounded hover:bg-gray-500">
           Cancel
        </a>
        <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
           Update Booking
        </button>
      </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // full lists from blade
  const allFacilities = @json($facilities);
  const allCoaches    = @json($Coach);

  const sportSel    = document.getElementById('sport_type_id');
  const facilitySel = document.getElementById('facility_id');
  const coachSel    = document.getElementById('coach_id');

  function refill() {
    const sid = +sportSel.value;
    facilitySel.innerHTML = '';
    coachSel.innerHTML    = '';
    // populate matching facilities
    allFacilities
      .filter(f => f.sport_type_id === sid)
      .forEach(f => {
        const o = new Option(f.name, f.id);
        if (f.id === {{ $Bookings->facility_id }}) o.selected = true;
        facilitySel.add(o);
      });
    // populate matching coaches
    allCoaches
      .filter(c => c.sport_type_id === sid)
      .forEach(c => {
        const o = new Option(c.name, c.id);
        if (c.id === {{ $Bookings->coach_id }}) o.selected = true;
        coachSel.add(o);
      });
  }

  sportSel.addEventListener('change', refill);

  // on load: trigger refill to set current
  refill();
});
</script>
@endsection
