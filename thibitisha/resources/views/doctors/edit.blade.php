<x-app-layout>

<div class="container mt-4">

    <h2>Edit Doctor</h2>

    <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input class="form-control" name="name" value="{{ $doctor->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" name="email" type="email" value="{{ $doctor->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-control">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" 
                        {{ $doctor->role == $role->name ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back</a>

    </form>
</div>
</x-app-layout>
