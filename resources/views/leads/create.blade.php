<x-app-layout>
    <x-slot name="header">Create Lead</x-slot>

    <div class="p-4 max-w-md">
        <form method="POST" action="{{ route('leads.store') }}" class="space-y-4">
            @csrf
            <div>
                <label>Name</label>
                <input type="text" name="full_name" value="{{ old('full_name') }}" class="border p-2 w-full rounded">
                @error('full_name')<p class="text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="border p-2 w-full rounded">
                @error('phone')<p class="text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label>Status</label>
                <select name="status" class="border p-2 w-full rounded">
                    @foreach(['new','in_progress','done'] as $status)
                        <option value="{{ $status }}" @selected(old('status')==$status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                @error('status')<p class="text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label>Note</label>
                <textarea name="note" class="border p-2 w-full rounded">{{ old('note') }}</textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Lead</button>
        </form>
    </div>
</x-app-layout>
