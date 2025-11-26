<x-app-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold">Edit Role</h2>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>

        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input class="form-control" name="name" value="{{ old('name', $role->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <input class="form-control" name="description" value="{{ old('description', $role->description) }}">
            </div>

            <button class="btn btn-primary">
                <i class="bi bi-check-circle me-1"></i> Update Role
            </button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </form>
    </div>
</x-app-layout>
