<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Edit Lead</h2>
            <p class="text-sm text-gray-500 mt-1">
                Update lead information
            </p>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto p-6 space-y-6">

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
            <form method="POST" action="{{ route('leads.update', $lead) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Full Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input
                        type="text"
                        name="full_name"
                        value="{{ old('full_name', $lead->full_name) }}"
                        placeholder="John Doe"
                        class="w-full rounded-xl border-gray-300 px-4 py-2.5
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition"
                    >
                    @error('full_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $lead->phone) }}"
                        placeholder="+1 234 567 89"
                        class="w-full rounded-xl border-gray-300 px-4 py-2.5
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition"
                    >
                    @error('phone')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select
                        name="status"
                        class="w-full rounded-xl border-gray-300 px-4 py-2.5
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition"
                    >
                        @foreach(['new','in_progress','done'] as $status)
                            <option value="{{ $status }}" @selected(old('status', $lead->status) == $status)>
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Note -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Note</label>
                    <textarea
                        name="note"
                        rows="4"
                        placeholder="Additional information..."
                        class="w-full rounded-xl border-gray-300 px-4 py-2.5
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition"
                    >{{ old('note', $lead->note) }}</textarea>
                </div>

                <!-- Assigned User (optional) -->
                @if($users ?? false)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Assigned To</label>
                        <select
                            name="assigned_to"
                            class="w-full rounded-xl border-gray-300 px-4 py-2.5
                                   focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition"
                        >
                            <option value="">Unassigned</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @selected(old('assigned_to', $lead->assigned_to) == $user->id)>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <!-- Actions -->
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('leads.show', $lead) }}"
                       class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-xl
                               bg-gradient-to-r from-blue-600 to-indigo-600
                               font-semibold
                               shadow-md shadow-blue-500/30
                               hover:from-blue-700 hover:to-indigo-700
                               focus:ring-4 focus:ring-blue-300
                               transition"
                    >
                        Update Lead
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
