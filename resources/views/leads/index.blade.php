<x-app-layout>
    <x-slot name="header">Leads</x-slot>

    <div class="p-4">
        <form method="GET" class="mb-4 flex space-x-2">
            <input type="text" name="search" placeholder="Search" value="{{ request('search') }}"
                   class="border p-2 rounded w-1/3">
            <select name="status" class="border p-2 rounded">
                <option value="">All Status</option>
                @foreach(['new','in_progress','done'] as $status)
                    <option value="{{ $status }}" @selected(request('status')==$status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 rounded">Filter</button>
            <a href="{{ route('leads.create') }}" class="ml-auto bg-green-500 text-white px-4 rounded">New Lead</a>
        </form>

        <table class="w-full border">
            <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Phone</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($leads as $lead)
                <tr>
                    <td class="p-2 border">{{ $lead->full_name }}</td>
                    <td class="p-2 border">{{ $lead->phone }}</td>
                    <td class="p-2 border">{{ ucfirst($lead->status) }}</td>
                    <td class="p-2 border space-x-1">
                        <a href="{{ route('leads.show', $lead) }}" class="text-blue-500">View</a>
                        <a href="{{ route('leads.edit', $lead) }}" class="text-yellow-500">Edit</a>
                        <form action="{{ route('leads.destroy', $lead) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500"
                                    onclick="return confirm('Delete this lead?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $leads->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
