<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">📘 Subject Details</h2>
    </x-slot>

    <div class="py-10 max-w-6xl mx-auto px-4 space-y-8">

        {{-- Flash message --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- Subject Info --}}
        <div class="bg-white rounded-lg shadow p-6 space-y-2">
            <h3 class="text-lg font-semibold text-gray-800">📄 Overview</h3>
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
                <div><strong>Name:</strong> {{ $subject->name }}</div>
                <div><strong>Description:</strong> {{ $subject->description }}</div>
                <div><strong>Code:</strong> {{ $subject->subject_code }}</div>
                <div><strong>Credits:</strong> {{ $subject->credit_value }}</div>
                <div><strong>Created:</strong> {{ $subject->created_at->format('d M Y') }}</div>
                <div><strong>Updated:</strong> {{ $subject->updated_at->format('d M Y') }}</div>
                <div><strong>Teacher:</strong> {{ $subject->teacher->name ?? 'Unknown' }}
                    ({{ $subject->teacher->email ?? 'N/A' }})</div>
                <div class="col-span-2"><strong>👥 Enrolled Students:</strong> {{ $studentCount }}</div>
            </div>
        </div>

        {{-- Tasks Section --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">📋 Tasks</h3>

                @if (auth()->user()->isTeacher())
                    <a href="{{ route('tasks.create', $subject->id) }}"
                        class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
                        ➕ New Task
                    </a>
                @endif
            </div>

            @if ($subject->tasks->isEmpty())
                <p class="text-gray-600 text-sm">No tasks available for this subject.</p>
            @else
                <table class="min-w-full bg-white divide-y divide-gray-200 border rounded">
                    <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
                        <tr>
                            <th class="px-6 py-3 text-left">Task Name</th>
                            <th class="px-6 py-3 text-left">Points</th>

                            @if (auth()->user()->isStudent())
                                <th class="px-6 py-3 text-left">Status</th>
                            @endif
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

                                        {{-- For Students: show if submitted or not --}}
                                        @if (auth()->user()->isStudent())
                                                        @php
                                                            $submitted = $task->solutions()->where('user_id', auth()->id())->exists();
                                                        @endphp
                                                        <td class="px-6 py-4">
                                                            @if ($submitted)
                                                                <span class="text-green-600 font-semibold">✅ Submitted</span>
                                                            @else
                                                                <span class="text-red-500 font-semibold">❌ Not Submitted</span>
                                                            @endif
                                                        </td>
                                        @endif
                                    </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Enrolled Students Section --}}
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

        {{-- Back Button --}}
        <div>
            <a href="{{ route('subjects.index') }}" class="text-blue-600 hover:underline text-sm">
                ← Back to My Subjects
            </a>
        </div>
    </div>
</x-app-layout>