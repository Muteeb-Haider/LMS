<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">Teacher Dashboard</h2>
    </x-slot>

    <div class="py-10 max-w-6xl mx-auto space-y-8 px-4">

        <!-- Welcome Message -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Welcome, {{ auth()->user()->name }} (Teacher)</h3>
            <p class="text-gray-600">Here's a snapshot of your activity.</p>
        </div>

        <!-- Overview Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-blue-100 p-6 rounded-lg shadow">
                <h4 class="text-sm font-semibold text-gray-700">Subjects Created</h4>
                <p class="text-2xl mt-2">{{ $subjectsCount ?? '0' }}</p>
            </div>

            <div class="bg-yellow-100 p-6 rounded-lg shadow">
                <h4 class="text-sm font-semibold text-gray-700">Tasks Created</h4>
                <p class="text-2xl mt-2">{{ $tasksCount ?? '0' }}</p>
            </div>

            <div class="bg-green-100 p-6 rounded-lg shadow">
                <h4 class="text-sm font-semibold text-gray-700">Students Enrolled</h4>
                <p class="text-2xl mt-2">{{ $studentsCount ?? '0' }}</p>
            </div>
        </div>

        <!-- Motivation -->
        <div class="bg-green-100 p-6 rounded-lg shadow text-center">
            <p class="italic font-medium text-green-700">
                "A good teacher can inspire hope, ignite the imagination, and instill a love of learning."
            </p>
        </div>
    </div>
</x-app-layout>