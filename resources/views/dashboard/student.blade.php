<!-- resources/views/dashboard/student.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
    </x-slot>

    <div class="py-10 max-w-6xl mx-auto space-y-8 px-4">

        <!-- Welcome Message -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Welcome, {{ auth()->user()->name }} </h3>
            <p class="text-gray-600">Here's a quick overview of your progress.</p>
        </div>

        <!-- Overview Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-blue-100 p-6 rounded-lg shadow">
                <h4 class="text-sm font-semibold text-gray-700">Subjects Taken</h4>
                <p class="text-2xl mt-2">{{ $subjectsCount ?? '0' }}</p>
            </div>

            <div class="bg-yellow-100 p-6 rounded-lg shadow">
                <h4 class="text-sm font-semibold text-gray-700">Pending Tasks</h4>
                <p class="text-2xl mt-2">{{ $pendingTasksCount ?? '0' }}</p>
            </div>

            <div class="bg-green-100 p-6 rounded-lg shadow">
                <h4 class="text-sm font-semibold text-gray-700">Completed Tasks</h4>
                <p class="text-2xl mt-2">{{ $completedTasksCount ?? '0' }}</p>
            </div>
        </div>

        <!-- Upcoming Deadlines -->
        <div class="bg-white p-6 rounded-lg shadow space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Upcoming Deadlines</h3>
            @forelse ($upcomingTasks as $task)
                <div class="text-sm text-gray-700">
                    <strong>{{ $task->name }}</strong> - Due
                    {{ $task->due_date ? $task->due_date->diffForHumans() : 'No due date' }}
                </div>
            @empty
                <p class="text-gray-600">No upcoming tasks.</p>
            @endforelse
        </div>

        <!-- Motivation -->
        <div class="bg-purple-100 p-6 rounded-lg shadow text-center">
            <p class="italic font-medium text-purple-700">
                "Success is the sum of small efforts repeated day in and day out."
            </p>
        </div>
    </div>
</x-app-layout>