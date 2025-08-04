@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 max-w-lg">
        <h1 class="text-2xl font-bold mb-6">Edit Coaching Session</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('coachingsessions.update', $coachingSessions->id) }}" method="POST"
            class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            {{-- User Dropdown --}}
            <div class="mb-4">
                <label for="user_id" class="block font-semibold mb-2">Customer</label>
                <select name="user_id" id="user_id" class="form-select w-full px-3 py-2 border rounded">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ old('user_id', $coachingSessions->user_id) == $user->id ? 'selected' : '' }}>
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
              {{ old('sport_type_id', $coachingSessions->sport_type_id) == $type->id ? 'selected' : '' }}>
              {{ $type->name }}
            </option>
          @endforeach
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

            <div class="mb-4">
                <label for="coach_id" class="block font-semibold mb-2">Date</label>
                <input type="date" name="session_date"
                    value="{{ old('session_date', \Carbon\Carbon::parse($coachingSessions->session_date)->format('Y-m-d')) }}"
                    class="form-control w-full px-3 py-2 border rounded" required>

            </div>
            <div class="mb-4">
                <label for="coach_id" class="block font-semibold mb-2">Start Time</label>
                <input type="time" name="start_time" id="start_time" class="form-control w-full px-3 py-2 border rounded"
                    value="{{ old('start_time', $coachingSessions->start_time) }}" required>
            </div>
            <div class="mb-4">
                <label for="coach_id" class="block font-semibold mb-2">End Time</label>
                <input type="time" name="end_time" id="end_time" class="form-control w-full px-3 py-2 border rounded"
                    value="{{ old('end_time', $coachingSessions->end_time) }}" required>
            </div>

            {{-- Status Dropdown --}}
            <div class="mb-4">
                <label for="status" class="block font-semibold mb-2">Status</label>
                @php
                    $status = old('status', $coachingSessions->status);
                @endphp
                <select name="status" id="status" class="form-select w-full px-3 py-2 border rounded">
                    <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('coachingsessions.index') }}"
                    class="bg-gray-400 text-black px-4 py-2 rounded hover:bg-gray-500">Cancel</a>
                <button type="submit" class="bg-green-600 text-black px-4 py-2 rounded hover:bg-green-700">Update
                    Coach</button>
            </div>
        </form>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', () => {
  // full lists from blade

  const allCoaches    = @json($coaches);

  const sportSel    = document.getElementById('sport_type_id');

  const coachSel    = document.getElementById('coach_id');

  function refill() {
    const sid = +sportSel.value;
    coachSel.innerHTML    = '';
  
   
    // populate matching coaches
    allCoaches
      .filter(c => c.sport_type_id === sid)
      .forEach(c => {
        const o = new Option(c.name, c.id);
        if (c.id === {{ $coachingSessions->coach_id }}) o.selected = true;
        coachSel.add(o);
      });
  }

  sportSel.addEventListener('change', refill);

  // on load: trigger refill to set current
  refill();
});
</script>
@endsection
