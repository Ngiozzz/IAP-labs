<x-app-layout>
    <div class="container mx-auto py-8">

        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Jobs List</h2>
            <a href="{{ route('jobs.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Add Job
            </a>
        </div>

        <!-- Card Container -->
        <div class="bg-white shadow-sm rounded p-6">

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Queue</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payload</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attempts</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reserved At</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Available At</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($jobs as $job)
                            <tr>
                                <td class="px-4 py-2">{{ $job->id }}</td>
                                <td class="px-4 py-2">{{ $job->queue }}</td>
                                <td class="px-4 py-2"><pre class="whitespace-pre-wrap">{{ Str::limit($job->payload, 100) }}</pre></td>
                                <td class="px-4 py-2">{{ $job->attempts }}</td>
                                <td class="px-4 py-2">{{ $job->reserved_at ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $job->available_at }}</td>
                                <td class="px-4 py-2">{{ $job->created_at }}</td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <a href="{{ route('jobs.edit', $job->id) }}" 
                                       class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded hover:bg-yellow-300 transition">Edit</a>

                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-200 text-red-800 px-2 py-1 rounded hover:bg-red-300 transition"
                                                onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                    No jobs found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
