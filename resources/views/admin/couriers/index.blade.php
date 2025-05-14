<x-AdminApp-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Couriers</h1>

        <a href="{{ route('admin.couriers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-3 inline-block">Add New Courier</a>

        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white shadow-md rounded-md">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Branch</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Created At</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Updated At</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($couriers as $courier)
                    <tr class="border-b">
                        <td class="px-6 py-3">{{ $courier->name }}</td>
                        <td class="px-6 py-3">{{ $courier->email }}</td>
                        <td class="px-6 py-3">{{ $courier->branch_name }}</td>
                        <td class="px-6 py-3">{{ $courier->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-3">{{ $courier->updated_at->format('d M Y') }}</td>
                        <td class="px-6 py-3 flex space-x-2">
                            <a href="{{ route('admin.couriers.edit', $courier->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md">Edit</a>
                            <form action="{{ route('admin.couriers.destroy', $courier->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-AdminApp-layout>
