<x-AdminApp-layout>
    <div class="container mx-auto px-6 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Hotels</h1>
            <a href="{{ route('admin.hotels.create') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition">Add Hotel</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto bg-white shadow-md p-5 rounded-lg border border-gray-300">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-gray-600">
                    <tr class="text-sm font-medium uppercase">
                        <th class="px-6 py-4 text-left border">Name</th>
                        <th class="px-6 py-4 text-left border">Email</th>
                        <th class="px-6 py-4 text-left border">Contact</th>
                        <th class="px-6 py-4 text-left border">City</th>
                        <th class="px-6 py-4 text-left border">State</th>
                        <th class="px-6 py-4 text-left border">Zip Code</th>
                        <th class="px-6 py-4 text-left border">Country</th>
                        <th class="px-6 py-4 text-left border">Created At</th>
                        <th class="px-6 py-4 text-left border">Updated At</th>
                        <th class="px-6 py-4 text-left border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hotels as $hotel)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border">{{ $hotel->name }}</td>
                            <td class="px-6 py-4 border">{{ $hotel->email }}</td>
                            <td class="px-6 py-4 border">{{ $hotel->contact }}</td>
                            <td class="px-6 py-4 border">{{ $hotel->city }}</td>
                            <td class="px-6 py-4 border">{{ $hotel->state }}</td>
                            <td class="px-6 py-4 border">{{ $hotel->zip_code }}</td>
                            <td class="px-6 py-4 border">{{ $hotel->country }}</td>
                            <td class="px-6 py-4 border">{{ $hotel->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 border">{{ $hotel->updated_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 border flex space-x-4">
                                <a href="{{ route('admin.hotels.edit', $hotel) }}"
                                    class="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 transition">Edit</a>
                                <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600 transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-AdminApp-layout>
