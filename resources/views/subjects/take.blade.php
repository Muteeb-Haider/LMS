<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">➕ Take a New Subject</h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 space-y-8">

        @if (session('success'))
            <div class="p-4 bg-green-100 text-green-800 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        @if ($subjects->isEmpty())
            <div class="text-center p-6 bg-yellow-100 text-yellow-800 rounded-lg shadow">
                🎯 Great job! You have already enrolled in all available subjects.
            </div>

            <div class="text-center mt-6">
                <a href="{{ route('subjects.index') }}"
                    class="inline-block px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-lg shadow">
                    ← Back to My Subjects
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($subjects as $subject)
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $subject->name }}</h3>
                        <p class="text-gray-600 text-sm mb-2">{{ $subject->description }}</p>
                        <div class="text-gray-500 text-xs mb-2">
                            <p><strong>Code:</strong> {{ $subject->subject_code }}</p>
                            <p><strong>Credits:</strong> {{ $subject->credit_value }}</p>
                            <p><strong>Teacher:</strong> {{ $subject->teacher->name ?? 'Unknown' }}</p>
                        </div>

                        <form method="POST" action="{{ route('subjects.enroll', $subject->id) }}">
                            @csrf
                            <button type="submit"
                                class="w-full mt-3 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-lg text-sm transition">
                                🎓 Take Subject
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                <a href="{{ route('subjects.index') }}"
                    class="inline-block px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-lg shadow">
                    ← Back to My Subjects
                </a>
            </div>
        @endif
    </div>
</x-app-layout>