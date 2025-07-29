<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold">Evaluate Solution</h2>
    </x-slot>

    <div class="py-10 max-w-3xl mx-auto space-y-6">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold mb-4">📝 Task: {{ $task->name }}</h3>
            <p><strong>Description:</strong> {{ $task->description }}</p>
            <p><strong>Max Points:</strong> {{ $task->points }}</p>
            <p><strong>Solution:</strong></p>
            <div class="p-3 bg-gray-100 rounded border whitespace-pre-line">{{ $solution->content }}</div>
            <div class="mt-4 text-sm text-gray-600">
                <p><strong>Submitted At:</strong> {{ $solution->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <form action="{{ route('solutions.evaluate.store', [$subject->id, $task->id, $solution->id]) }}" method="POST"
            class="space-y-4">
            @csrf
            <div>
                <label for="points" class="block font-medium">Give Points (0 - {{ $task->points }})</label>
                <input type="number" name="points" id="points" class="w-full border rounded p-2"
                    value="{{ old('points') }}" min="0" max="{{ $task->points }}" required>
                @error('points')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <x-primary-button>✅ Submit Evaluation</x-primary-button>
        </form>

        <a href="{{ route('tasks.show', [$task->subject_id, $task->id]) }}"
            class="text-blue-600 underline mt-4 inline-block">← Back to Task</a>
    </div>
</x-app-layout>