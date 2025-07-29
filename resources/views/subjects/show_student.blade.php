<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">📘 Subject Details (Student View)</h2>
    </x-slot>

    <div class="py-10 max-w-6xl mx-auto px-4 space-y-8">

        {{-- Subject Info --}}
        <div class="bg-white rounded-lg shadow p-6 space-y-2">
            <h3 class="text-lg font-semibold text-gray-800">📄 Overview</h3>
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
                <div><strong>Name:</strong> {{ $subject->name }}</div>
                <div><strong>Description:</strong> {{ $subject->description }}</div>
                <div><strong>Code:</strong> {{ $subject->subject_code }}</div>
                <div><strong>Credits:</strong> {{ $subject->credit_value }}</div>
                <div><strong>Created At:</strong> {{ $subject->created_at->format('d M Y') }}</div>
                <div><strong>Last Modified:</strong> {{ $subject->updated_at->format('d M Y') }}</div>
                <div><strong>Teacher:</strong> {{ $subject->teacher->name }} ({{ $subject->teacher->email }})</div>
                <div><strong>Number of Students:</strong> {{ $studentCount }}</div>
            </div>
        </div>

        {{-- Students List --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">👩‍🎓 Enrolled Students</h3>
            @forelse ($students as $student)
                <div class="text-sm text-gray-700 mb-2">
                    <strong>{{ $student->name }}</strong> — {{ $student->email }}
                </div>
            @empty
                <p class="text-sm text-gray-600">No students enrolled yet.</p>
            @endforelse
        </div>

        {{-- Tasks List --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">📋 Tasks</h3>

            @if ($subject->tasks->isEmpty())
                <p class="text-gray-600 text-sm">No tasks available for this subject.</p>
            @else
                <table class="min-w-full bg-white divide-y divide-gray-200 border rounded">
                    <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
                        <tr>
                            <th class="px-6 py-3 text-left">Task Name</th>
                            <th class="px-6 py-3 text-left">Points</th>
                            <th class="px-6 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                        @foreach ($subject->tasks as $task)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <a href="{{ route('tasks.show', [$subject->id, $task->id]) }}"
                                        class="text-blue-600 hover:underline font-medium">
                                        {{ $task->name }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">{{ $task->points }}</td>
                                <td class="px-6 py-4">
                                    @if($task->solutions->where('user_id', auth()->id())->count())
                                        <span class="text-green-600 font-semibold">✅ Submitted</span>
                                    @else
                                        <span class="text-red-600 font-semibold">❌ Not Submitted</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Back to Subjects --}}
        <div>
            <a href="{{ route('subjects.index') }}" class="text-blue-600 hover:underline text-sm">
                ← Back to My Subjects
            </a>
        </div>
    </div>
</x-app-layout>