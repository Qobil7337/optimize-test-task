<x-app-layout>
    <x-slot name="header">Lead Details</x-slot>

    <div class="p-4 max-w-2xl">
        <div class="mb-4">
            <h2 class="text-lg font-bold">{{ $lead->full_name }}</h2>
            <p>Phone: {{ $lead->phone }}</p>
            <p>Status: {{ ucfirst($lead->status) }}</p>
            <p>Note: {{ $lead->note }}</p>
        </div>

        <h3 class="text-md font-semibold mb-2">Tasks</h3>

        <form method="POST" action="{{ route('tasks.store', $lead) }}" class="mb-4 flex space-x-2">
            @csrf
            <input type="text" name="title" placeholder="New task" class="border p-2 rounded flex-1">
            <button type="submit" class="bg-green-500 text-white px-4 rounded">Add</button>
        </form>

        <ul class="space-y-2">
            @foreach($lead->tasks as $task)
                <li class="flex justify-between items-center p-2 border rounded">
                    <span class="{{ $task->is_done ? 'line-through text-gray-500' : '' }}">{{ $task->title }}</span>
                    <div class="space-x-1">
                        <form method="POST" action="{{ route('tasks.update', $task) }}" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_done" value="{{ $task->is_done ? 0 : 1 }}">
                            <button type="submit" class="text-blue-500">{{ $task->is_done ? 'Undo' : 'Done' }}</button>
                        </form>
                        <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
