<x-app-layout>
  <x-slot name="header">
    <h2 class="text-2xl font-semibold">Take a New Subject</h2>
  </x-slot>

  <div class="py-8 max-w-4xl mx-auto space-y-6">
    @foreach(\App\Models\Subject::whereDoesntHave('students', fn($q) => $q->where('user_id', auth()->id()))->get() as $sub)
      <div class="p-4 border rounded flex justify-between items-center">
        <div>
          <div class="font-medium">{{ $sub->name }}</div>
          <div class="text-sm text-gray-600">{{ $sub->subject_code }} &middot; {{ $sub->credit_value }} cr.</div>
        </div>
        <form method="POST" action="{{ route('subjects.enroll', $sub) }}">
          @csrf
          <button type="submit"
            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">
            Take
          </button>
        </form>
      </div>
    @endforeach
  </div>
</x-app-layout>
