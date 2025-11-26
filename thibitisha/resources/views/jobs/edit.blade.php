<x-app-layout>
    <div class="container mx-auto py-8">

        <!-- Page Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-primary">Edit Job</h2>
            <a href="{{ route('jobs.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition flex items-center">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <strong>Oops!</strong> Please fix the errors below:
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white shadow-sm rounded p-6">
            <form action="{{ route('jobs.update', $job->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="block text-gray-700 font-medium mb-1">Queue</label>
                    <input type="text" name="queue" value="{{ old('queue', $job->queue) }}" 
                           class="form-control w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-3">
                    <label class="block text-gray-700 font-medium mb-1">Payload</label>
                    <textarea name="payload" rows="5" 
                              class="form-control w-full border rounded px-3 py-2" required>{{ old('payload', $job->payload) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="block text-gray-700 font-medium mb-1">Attempts</label>
                    <input type="number" name="attempts" value="{{ old('attempts', $job->attempts) }}" 
                           class="form-control w-full border rounded px-3 py-2">
                </div>

                <div class="mb-3">
                    <label class="block text-gray-700 font-medium mb-1">Available At (timestamp)</label>
                    <input type="number" name="available_at" value="{{ old('available_at', $job->available_at) }}" 
                           class="form-control w-full border rounded px-3 py-2" required>
                </div>

                <div class="flex gap-2 mt-4">
                    <button type="submit" 
                            class="btn btn-success bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition flex items-center">
                        <i class="bi bi-check-circle me-1"></i> Update Job
                    </button>
                    <a href="{{ route('jobs.index') }}" 
                       class="btn btn-secondary bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition flex items-center">
                        <i class="bi bi-arrow-left-circle me-1"></i> Back
                    </a>
                </div>

            </form>
        </div>

    </div>
</x-app-layout>
