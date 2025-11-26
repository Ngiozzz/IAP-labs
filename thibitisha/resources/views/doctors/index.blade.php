<x-app-layout>
    <div class="container mt-5">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold">Doctors List</h2>
            <a href="{{ route('doctors.create') }}" class="btn text-white" style="background-color: #0A1A44;">
                <i class="bi bi-plus-circle me-1"></i> Add Doctor
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
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $doctor)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $doctor->name }}</td>
                                    <td>{{ $doctor->email }}</td>
                                    <td>{{ $doctor->role }}</td>
                                    <td class="text-center d-flex justify-content-center gap-2">

                                        <!-- Edit Button -->
                                        <a href="{{ route('doctors.edit', $doctor->id) }}" 
                                           class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST">
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
                                    <td colspan="4" class="text-center text-muted p-4">
                                        No doctors found. Click "Add Doctor" to start.
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
