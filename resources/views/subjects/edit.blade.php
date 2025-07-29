<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">📘 Edit Subject</h2>
    </x-slot>

    <div class="py-10 max-w-4xl mx-auto px-4">
        <div class="bg-white shadow rounded-lg p-6 space-y-6">
            <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="name" :value="'Subject Name'" />
                    <x-text-input id="name" name="name" type="text" class="w-full mt-1"
                        value="{{ old('name', $subject->name) }}" required />
                </div>

                <div>
                    <x-input-label for="description" :value="'Description'" />
                    <textarea id="description" name="description"
                        class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:ring focus:ring-blue-200"
                        rows="4">{{ old('description', $subject->description) }}</textarea>
                </div>

                <div>
                    <x-input-label for="subject_code" :value="'Subject Code (e.g. IK-ABC123)'" />
                    <x-text-input id="subject_code" name="subject_code" type="text" class="w-full mt-1"
                        value="{{ old('subject_code', $subject->subject_code) }}" required />
                </div>

                <div>
                    <x-input-label for="credit_value" :value="'Credit Value'" />
                    <x-text-input id="credit_value" name="credit_value" type="number" class="w-full mt-1"
                        value="{{ old('credit_value', $subject->credit_value) }}" required />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <x-primary-button>✅ Update Subject</x-primary-button>

                    <a href="{{ route('subjects.index') }}" class="text-sm text-blue-600 hover:underline">
                        ← Back to My Subjects
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>