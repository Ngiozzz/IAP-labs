<x-app-layout>
    <div class="container mt-5">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold">Roles List</h2>
            <a href="{{ route('roles.create') }}" class="btn text-white" style="background-color: #0A1A44;">
                <i class="bi bi-plus-circle me-1"></i> Add Role
            </a>
        </div>

        <!-- Table Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col" class="text-center">Created At</th>
                                <th scope="col" class="text-center">Updated At</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->description ?? '-' }}</td>
                                    <td class="text-center">{{ $role->created_at ? \Carbon\Carbon::parse($role->created_at)->format('d-M-Y') : '-' }}</td>
                                    <td class="text-center">{{ $role->updated_at ? \Carbon\Carbon::parse($role->updated_at)->format('d-M-Y') : '-' }}</td>
                                    <td class="text-center d-flex justify-content-center gap-2">

                                        <!-- Edit Button -->
                                        <a href="{{ route('roles.edit', $role->id) }}" 
                                           class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash me-1"></i> Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted p-4">
                                        No roles found. Click "Add Role" to start.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
