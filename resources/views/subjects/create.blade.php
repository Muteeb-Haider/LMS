<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-gray-800">
            {{ auth()->user()->isTeacher() ? 'Create New Subject' : 'Available Subjects' }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-6xl mx-auto px-4">
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- ✅ TEACHER FORM --}}
        @if (auth()->user()->isTeacher())
            <div class="overflow-x-auto bg-white rounded-xl shadow p-6">
                <form action="{{ route('subjects.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block font-medium text-gray-700">Subject Name</label>
                        <input type="text" name="name" class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                            value="{{ old('name') }}">
                        @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Description</label>
                        <textarea name="description"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Subject Code (e.g., IK-ABC123)</label>
                        <input type="text" name="subject_code" class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                            value="{{ old('subject_code') }}">
                        @error('subject_code') <span
                        class="text-red-600 text-sm">{{ $errors->first('subject_code') }}</span> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Credit Value</label>
                        <input type="number" name="credit_value" class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                            value="{{ old('credit_value') }}">
                        @error('credit_value') <span
                        class="text-red-600 text-sm">{{ $errors->first('credit_value') }}</span> @enderror
                    </div>

                    <div>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded w-full">
                            Create Subject
                        </button>
                    </div>
                </form>
            </div>
        @endif

        {{-- ✅ STUDENT SUBJECT LIST --}}
        @if (auth()->user()->isStudent())
            <div class="overflow-x-auto bg-white rounded-xl shadow mt-6">
                @if ($subjects->isEmpty())
                    <div class="p-6 text-gray-600">
                        No subjects available to take.
                    </div>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                {{-- ✅ ADDED --}}
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Credits</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Teacher</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($subjects as $subject)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $subject->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $subject->description }}
                                    </td> {{-- ✅ ADDED --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $subject->subject_code }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $subject->credit_value }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $subject->teacher->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form method="POST" action="{{ route('subjects.enroll', $subject->id) }}">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded text-sm">
                                                Enroll
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @endif
    </div>
</x-app-layout>