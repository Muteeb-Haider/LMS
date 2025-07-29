<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-gray-800">
            📚 {{ auth()->user()->isTeacher() ? 'Subjects' : 'My Subjects' }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-6xl mx-auto px-4 space-y-8">
        <!-- {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif -->

        {{-- ✅ Only show Take New Subject Button to Students --}}
        @if (auth()->user()->isStudent())
            <div class="mb-6 text-right">
                <a href="{{ route('subjects.create') }}"
                    class="inline-block px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow">
                    ➕ Take a New Subject
                </a>
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Credits</th>
                        @if (auth()->user()->isStudent())
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Teacher</th>
                        @endif
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($subjects as $subject)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                                <a href="{{ route('subjects.show', $subject->id) }}" class="hover:underline">
                                    {{ $subject->name }}
                                </a>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $subject->subject_code }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $subject->credit_value }}
                            </td>

                            @if (auth()->user()->isStudent())
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $subject->teacher->name ?? 'Unknown' }}
                                </td>
                            @endif

                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if (auth()->user()->isTeacher())
                                    <a href="{{ route('subjects.edit', $subject->id) }}"
                                        class="text-blue-600 hover:underline mr-2">
                                        Edit
                                    </a> |
                                    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST"
                                        class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="text-red-600 hover:underline ml-2 delete-button">
                                            Delete
                                        </button>
                                    </form>
                                @elseif (auth()->user()->isStudent())
                                    <form method="POST" action="{{ route('subjects.leave', $subject->id) }}"
                                        class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="text-red-600 hover:underline delete-button">
                                            Drop Subject
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->isStudent() ? 5 : 4 }}"
                                class="text-center py-6 text-sm text-gray-500">
                                No subjects found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ✅ Push SweetAlert script --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, confirm it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.closest('.delete-form').submit();
                        }
                    })
                });
            });
        </script>
    @endpush
</x-app-layout>
<script>
    document.querySelectorAll('.leave-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You will leave this subject!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>