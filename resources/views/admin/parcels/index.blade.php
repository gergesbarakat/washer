<x-AdminApp-layout>
    <div class="p-6 max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Parcels</h1>

        <a href="{{ route('admin.parcels.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
            + New Parcel
        </a>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Hotel</th>
                    <th class="px-4 py-2">Branch</th>
                    <th class="px-4 py-2">Courier</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Created</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($parcels as $parcel)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $parcel->id }}</td>
                        <td class="px-4 py-2">{{ $parcel->hotel->name }}</td>
                        <td class="px-4 py-2">{{ $parcel->branch->name }}</td>
                        <td class="px-4 py-2">{{ $parcel->courier->name ?? '—' }}</td>
                        <td class="px-4 py-2">{{ ucfirst($parcel->status) }}</td>
                        <td class="px-4 py-2">{{ $parcel->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <button onclick="viewParcel({{ $parcel->id }})" class="text-green-600">👁 View</button>
                            <a href="{{ route('admin.parcels.edit', $parcel->id) }}" class="text-blue-600">Edit</a>
                            <form class="inline-block" method="POST"
                                action="{{ route('admin.parcels.destroy', $parcel->id) }}"
                                onsubmit="return confirm('Delete this parcel?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center px-4 py-6 text-gray-500">No parcels found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

<!-- Modal -->
<div id="parcelModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 overflow-y-auto">
    <div class="flex min-h-screen items-center justify-center px-4 py-12">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative animate-fadeIn">
            <button onclick="closeModal()" class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-2xl font-bold">&times;</button>

            <h2 class="text-2xl font-bold text-blue-700 mb-4 border-b pb-2">Parcel Details</h2>

            <div class="grid grid-cols-2 gap-4 mb-6 text-sm text-gray-700">
                <div>
                    <p class="font-semibold text-gray-900">Hotel:</p>
                    <p id="modalHotel" class="mt-1 text-gray-600">—</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Branch:</p>
                    <p id="modalBranch" class="mt-1 text-gray-600">—</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Courier:</p>
                    <p id="modalCourier" class="mt-1 text-gray-600">—</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Status:</p>
                    <p id="modalStatus" class="mt-1 text-gray-600">—</p>
                </div>
            </div>

            <h3 class="text-lg font-semibold text-gray-800 mb-2">Parcel Items</h3>
            <div id="parcelItems" class="space-y-2 max-h-60 overflow-y-auto pr-2">
                <!-- Items will be dynamically added here -->
            </div>

            <div class="text-right mt-6">
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

    <!-- Pass parcel data to JS -->
    <script>
        const parcels = @json($parcels);

        function viewParcel(parcelId) {
            const parcel = parcels.find(p => p.id === parcelId);
            if (!parcel) return;

            document.getElementById('modalHotel').textContent = parcel.hotel?.name || 'N/A';
            document.getElementById('modalBranch').textContent = parcel.branch?.name || 'N/A';
            document.getElementById('modalCourier').textContent = parcel.courier?.name || 'N/A';
            document.getElementById('modalStatus').textContent = parcel.status || 'N/A';

            const itemsContainer = document.getElementById('parcelItems');
            itemsContainer.innerHTML = '';

            if (parcel.items && parcel.items.length > 0) {
                parcel.items.forEach(item => {
                    const div = document.createElement('div');
                    div.className = "border px-4 py-2 rounded bg-gray-50";
                    div.innerHTML =
                        `<strong>${item.product?.name || 'Unnamed product'}</strong> - Quantity: ${item.quantity}`;
                    itemsContainer.appendChild(div);
                });
            } else {
                itemsContainer.innerHTML = '<p class="text-gray-500">No items found for this parcel.</p>';
            }

            document.getElementById('parcelModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('parcelModal').classList.add('hidden');
        }
    </script>
</x-AdminApp-layout>
