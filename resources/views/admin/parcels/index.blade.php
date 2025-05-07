<x-AdminApp-layout>
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <h1 class="text-2xl font-bold">Parcels</h1>
            <a href="{{ route('admin.parcels.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Parcel</a>
        </div>
        <div class="bg-white shadow-md rounded my-6">
            <table id="parcels-table" class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Sender</th>
                        <th class="py-3 px-6 text-left">Recipient</th>
                        <th class="py-3 px-6 text-left">Courier</th>
                        <th class="py-3 px-6 text-left">Type</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($parcels as $parcel)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">{{ $parcel->id }}</td>
                        <td class="py-3 px-6 text-left">{{ $parcel->sender_name }}</td>
                        <td class="py-3 px-6 text-left">{{ $parcel->recipient_name }}</td>
                        <td class="py-3 px-6 text-left">{{ $parcel->courier->firstname ?? '-' }}</td>
                        <td class="py-3 px-6 text-left">{{ $parcel->type ? 'Deliver' : 'Pickup' }}</td>
                        <td class="py-3 px-6 text-center">
                            <a href="{{ route('admin.parcels.edit', $parcel->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
      </x-AdminApp-layout>
