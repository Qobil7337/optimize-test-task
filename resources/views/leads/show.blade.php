<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Lead Details</h2>
            <p class="text-sm text-gray-500 mt-1">
                View lead information and manage tasks
            </p>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6 space-y-8">

        <!-- Lead Info -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900">
                        {{ $lead->full_name }}
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        📞 {{ $lead->phone }}
                    </p>
                </div>

                @php
                    $statusClasses = match($lead->status) {
                        'new' => 'bg-blue-100 text-blue-700',
                        'in_progress' => 'bg-yellow-100 text-yellow-700',
                        'done' => 'bg-green-100 text-green-700',
                        default => 'bg-gray-100 text-gray-700',
                    };
                @endphp

                <span class="px-4 py-1.5 rounded-full text-sm font-semibold {{ $statusClasses }}">
                    {{ ucfirst(str_replace('_',' ', $lead->status)) }}
                </span>
            </div>

            @if($lead->note)
                <div class="mt-4 bg-gray-50 border border-gray-200 rounded-xl p-4">
                    <p class="text-sm text-gray-700">
                        {{ $lead->note }}
                    </p>
                </div>
            @endif
        </div>

        <!-- Tasks -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                Tasks
            </h3>

            <!-- Add Task -->
            <form
                method="POST"
                action="{{ route('tasks.store', $lead) }}"
                class="flex flex-col sm:flex-row gap-3 mb-6"
            >
                @csrf
                <input
                    type="text"
                    name="title"
                    placeholder="Add a new task..."
                    class="flex-1 rounded-xl border-gray-300 px-4 py-2.5
                           focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition"
                    required
                >

                <button
                    type="submit"
                    class="px-6 py-2.5 rounded-xl
                           bg-gradient-to-r from-green-600 to-emerald-600
                           font-semibold
                           shadow-md shadow-green-500/30
                           hover:from-green-700 hover:to-emerald-700
                           focus:ring-4 focus:ring-green-300
                           transition"
                >
                    + Add Task
                </button>
            </form>

            <!-- Task List -->
            <ul class="space-y-3">
                @forelse($lead->tasks as $task)
                    <li
                        class="flex items-center justify-between gap-4
                               p-4 rounded-xl border
                               {{ $task->is_done ? 'bg-gray-50 border-gray-200' : 'bg-white border-gray-200' }}"
                    >
                        <span class="text-sm font-medium
                                     {{ $task->is_done ? 'line-through text-gray-400' : 'text-gray-800' }}">
                            {{ $task->title }}
                        </span>

                        <div class="flex items-center gap-2">
                            <!-- Done / Undo -->
                            <form method="POST" action="{{ route('tasks.update', $task) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="is_done" value="{{ $task->is_done ? 0 : 1 }}">
                                <button
                                    type="submit"
                                    class="px-3 py-1.5 rounded-lg text-xs font-semibold
                                           {{ $task->is_done
                                                ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200'
                                                : 'bg-blue-100 text-blue-700 hover:bg-blue-200'
                                           }}
                                           transition"
                                >
                                    {{ $task->is_done ? 'Undo' : 'Done' }}
                                </button>
                            </form>

                            <!-- Delete -->
                            <form
                                method="POST"
                                action="{{ route('tasks.destroy', $task) }}"
                                onsubmit="return confirm('Delete this task?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="px-3 py-1.5 rounded-lg text-xs font-semibold
                                           bg-red-100 text-red-700 hover:bg-red-200
                                           transition"
                                >
                                    Delete
                                </button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="text-center text-sm text-gray-500 py-6">
                        No tasks yet. Add one above 👆
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
