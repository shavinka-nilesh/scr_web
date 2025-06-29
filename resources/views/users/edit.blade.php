@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 max-w-lg">
        <h1 class="text-2xl font-bold mb-6">Edit User Details</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $User->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $User->name) }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>


            {{-- <div class="mb-4">
                <label for="sport_type" class="block font-semibold mb-2">Sport Type</label>
                <select name="sport_type" id="sport_type" class="form-select w-full px-3 py-2 border rounded">
                    @foreach ($SportType as $coach)
                        <option value="{{ $coach->name }}"
                            {{ old('sport_type', $facility->sport_type) == $coach->name ? 'selected' : '' }}>
                            {{ $coach->name }}
                        </option>
                    @endforeach
                </select>
            </div> --}}

            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-semibold mb-2">Role</label>
                <select name="role" id="role" class="form-select w-full px-3 py-2 border rounded" required>
                    <option value="user" {{ old('role', $User->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role', $User->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>

            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="text" name="email" id="email" value="{{ old('email', $User->email) }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>
            <div class="mb-4">
                <label for="phone_number" class="block text-gray-700 font-semibold mb-2">Telephone</label>
                <input type="text" name="phone_number" id="phone_number"
                    value="{{ old('phone_number', $User->phone_number) }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>
            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-semibold mb-2">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address', $User->address) }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>
            {{-- <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Existing Images</label>
                <div class="flex flex-wrap gap-4">
                    @forelse($facility->images as $image)
                        <div class="relative w-24 h-24 group">
                            <div class="relative w-24 h-24 group">
                                <img src="{{ asset('storage/' . $image->path) }}"
                                    class="object-cover w-full h-full rounded border" alt="Facility Image">
                                <button
                                    class="absolute top-0 right-0 m-1 bg-black text-white rounded-full w-6 h-6 text-xs delete-image-btn"
                                    data-id="{{ $image->id }}" title="Delete image">
                                    ✕
                                </button>
                            </div>

                        </div>
                    @empty
                        <p class="text-gray-500">No images uploaded.</p>
                    @endforelse
                </div>
            </div> --}}
            {{-- <div id="previewNewImages" class="flex gap-2 flex-wrap mb-4"></div>
            <div class="mb-4">
                <label for="images" class="block text-gray-700 font-semibold mb-2">Upload Images (select multiple images
                    at once)</label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple
                    class="w-full border border-gray-300 rounded px-3 py-2" onchange="previewSelectedImages()" />


            </div> --}}

            <div class="flex justify-between">
                <a href="{{ route('users.index') }}"
                    class="bg-gray-400 text-black px-4 py-2 rounded hover:bg-gray-500">Cancel</a>
                <button type="submit" class="bg-green-600 text-black px-4 py-2 rounded hover:bg-green-700">Update
                    User</button>
            </div>
        </form>

        <!-- Change Password Modal Trigger -->
<button type="button" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
    Change Password
</button>

<!-- Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="changePasswordForm" method="POST" action="{{ route('users.change-password', $User->id) }}">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordModalLabel">Change User Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" name="new_password" id="new_password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="admin_password" class="form-label">Your Password</label>
            <input type="password" name="admin_password" id="admin_password" class="form-control" required placeholder="Re-enter your password to confirm">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Change Password</button>
        </div>
      </div>
    </form>
  </div>
</div>

    </div>
@endsection
<script>
    function previewSelectedImages() {
        const input = document.getElementById('images');
        const preview = document.getElementById('previewNewImages');
        preview.innerHTML = ''; // Clear previous previews

        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = "w-24 h-24 object-cover rounded border shadow";
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.delete-image-btn');

        buttons.forEach(btn => {
            btn.addEventListener('click', function() {
                const imageId = this.dataset.id;
                if (!confirm('Are you sure you want to delete this image?')) return;

                axios.delete(`/facility-image/${imageId}`, {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        if (response.data.success) {
                            this.closest('.relative').remove();
                        } else {
                            alert('Error deleting image');
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Something went wrong');
                    });
            });
        });
    });
</script>
