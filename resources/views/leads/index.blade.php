<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">Leads</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Manage and track your leads
                </p>
            </div>

            <a
                href="{{ route('leads.create') }}"
                class="inline-flex items-center px-5 py-2.5 rounded-xl
                       bg-gradient-to-r from-green-600 to-emerald-600
                       font-semibold
                       shadow-md shadow-green-500/30
                       hover:from-green-700 hover:to-emerald-700
                       focus:ring-4 focus:ring-green-300
                       transition"
            >
                + New Lead
            </a>
        </div>
    </x-slot>

    <div class="p-6 space-y-6">

        <!-- Filters -->
        <form method="GET" class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm">
            <div class="flex flex-wrap gap-3 items-center">
                <input
                    type="text"
                    name="search"
                    placeholder="Search by name or phone..."
                    value="{{ request('search') }}"
                    class="flex-1 min-w-[200px] rounded-xl border-gray-300 px-4 py-2.5
                           focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition"
                >

                <select
                    name="status"
                    class="rounded-xl border-gray-300 px-4 py-2.5
                           focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition"
                >
                    <option value="">All statuses</option>
                    @foreach(['new','in_progress','done'] as $status)
                        <option value="{{ $status }}" @selected(request('status') == $status)>
                            {{ ucfirst(str_replace('_',' ', $status)) }}
                        </option>
                    @endforeach
                </select>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-xl
                           bg-blue-600 font-semibold
                           hover:bg-blue-700 focus:ring-4 focus:ring-blue-300
                           transition"
                >
                    Filter
                </button>
            </div>
        </form>

        <!-- Table -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-5 py-3 text-left">Name</th>
                    <th class="px-5 py-3 text-left">Phone</th>
                    <th class="px-5 py-3 text-left">Status</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
                </thead>

                <tbody class="divide-y">
                @forelse($leads as $lead)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-3 font-medium text-gray-900">
                            {{ $lead->full_name }}
                        </td>

                        <td class="px-5 py-3 text-gray-600">
                            {{ $lead->phone }}
                        </td>

                        <td class="px-5 py-3">
                            @php
                                $statusClasses = match($lead->status) {
                                    'new' => 'bg-blue-100 text-blue-700',
                                    'in_progress' => 'bg-yellow-100 text-yellow-700',
                                    'done' => 'bg-green-100 text-green-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClasses }}">
                                    {{ ucfirst(str_replace('_',' ', $lead->status)) }}
                                </span>
                        </td>

                        <td class="px-5 py-3 text-right space-x-3">
                            <a
                                href="{{ route('leads.show', $lead) }}"
                                class="text-blue-600 hover:underline font-medium"
                            >
                                View
                            </a>

                            <a
                                href="{{ route('leads.edit', $lead) }}"
                                class="text-yellow-600 hover:underline font-medium"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('leads.destroy', $lead) }}"
                                method="POST"
                                class="inline"
                                onsubmit="return confirm('Delete this lead?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="text-red-600 hover:underline font-medium"
                                >
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-8 text-center text-gray-500">
                            No leads found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div>
            {{ $leads->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
