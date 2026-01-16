<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-900">
            Create Lead
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Add a new lead to your CRM
        </p>
    </x-slot>

    <div class="max-w-xl mx-auto mt-10 px-4">
        <div class="bg-gradient-to-br from-white to-gray-50 border border-gray-200 shadow-lg rounded-2xl p-6">
            <form method="POST" action="{{ route('leads.store') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Full name
                    </label>
                    <input
                        type="text"
                        name="full_name"
                        value="{{ old('full_name') }}"
                        placeholder="John Doe"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                               transition"
                    >
                    @error('full_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Phone number
                    </label>
                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="+1 234 567 89"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                               transition"
                    >
                    @error('phone')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Status
                    </label>
                    <select
                        name="status"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                               transition"
                    >
                        @foreach(['new','in_progress','done'] as $status)
                            <option value="{{ $status }}" @selected(old('status') == $status)>
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
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Note
                    </label>
                    <textarea
                        name="note"
                        rows="4"
                        placeholder="Additional information..."
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                               transition"
                    >{{ old('note') }}</textarea>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-6">
                    <!-- Cancel -->
                    <a
                        href="{{ route('leads.index') }}"
                        class="text-sm font-medium text-gray-600 hover:text-gray-900 transition"
                    >
                        ← Back to leads
                    </a>

                    <!-- Submit -->
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2
                               px-6 py-3 rounded-xl
                               bg-gradient-to-r from-blue-600 to-indigo-600
                               font-semibold
                               shadow-md shadow-blue-500/30
                               hover:from-blue-700 hover:to-indigo-700
                               focus:ring-4 focus:ring-blue-300
                               transition-all"
                    >
                        Create Lead
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
