<x-AdminApp-layout>
    <div class="w-full bg-white   rounded mx-auto p-6">
        <div class="flex justify-between items-center mb-6 ">

            <h1 class="text-2xl font-bold mb-4">Couriers</h1>

            <a href="{{ route('admin.couriers.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-md mb-3 inline-block">Add New Courier</a>
        </div>
        <button id="generate-pdf" data-id="invoice-table" data-type="table"
            class="generate-pdf bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Generate
            PDF</button>
        <button onclick="exportToExcel()"
            class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">Export
            to Excel</button>

        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full table-auto  " id="invoice-table">
            <thead>
                <tr class="bg-blue-100">
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Branch</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">status</th>

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
                        <td
                            class="px-4 py-2     font-sans text-xs font-bold {{ $courier->status == '0' ? 'text-red-500  ' : 'text-green-500  *:' }} uppercase rounded-md select-none whitespace-nowrap ">
                            {{ $courier->status == '1' ? 'Activated' : 'DeActivated' }}

                        </td>
                        <td class="px-6 py-3">{{ $courier->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-3">{{ $courier->updated_at->format('d M Y') }}</td>
                        <td class="px-6 py-3 flex space-x-2">
                            <a href="{{ route('admin.couriers.edit', $courier->id) }}"
                                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Edit</a>
                            @if ($courier->status)
                                <!-- Deactivate Button -->
                                <form action="{{ route('admin.couriers.destroy', $courier->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to deactivate this courier?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">Deactivate</button>
                                </form>
                            @else
                                <!-- Activate Button -->
                                <form action="{{ route('admin.couriers.activate', $courier->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to activate this courier?');">
                                    @csrf
                                    <button type="submit"
                                        class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">Activate</button>
                                </form>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-AdminApp-layout>
