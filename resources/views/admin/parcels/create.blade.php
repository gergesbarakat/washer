<x-AdminApp-layout>

    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <h1 class="text-2xl font-bold">Add Parcel</h1>
        </div>

        <form action="{{ route('admin.parcels.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h2 class="font-semibold text-lg mb-2">Sender Information</h2>
                    <input type="text" name="sender_name" placeholder="Sender Name"
                        class="w-full border rounded p-2 mb-2" required>
                    <input type="text" name="sender_address" placeholder="Sender Address"
                        class="w-full border rounded p-2 mb-2" required>
                    <input type="text" name="sender_contact" placeholder="Sender Contact"
                        class="w-full border rounded p-2 mb-2" required>
                </div>
                <div>
                    <h2 class="font-semibold text-lg mb-2">Recipient Information</h2>
                    <input type="text" name="recipient_name" placeholder="Recipient Name"
                        class="w-full border rounded p-2 mb-2" required>
                    <input type="text" name="recipient_address" placeholder="Recipient Address"
                        class="w-full border rounded p-2 mb-2" required>
                    <input type="text" name="recipient_contact" placeholder="Recipient Contact"
                        class="w-full border rounded p-2 mb-2" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block mb-1">Courier</label>
                    <select name="courier_id" class="w-full border rounded p-2" required>
                        @foreach ($couriers as $courier)
                            <option value="{{ $courier->id }}">{{ $courier->firstname }} {{ $courier->lastname }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-1">Type</label>
                    <select name="type" class="w-full border rounded p-2" required>
                        <option value="1">Deliver</option>
                        <option value="0">Pickup</option>
                    </select>
                </div>
            </div>

            <h2 class="font-semibold text-lg mt-6 mb-2">Parcel Items</h2>
            <div id="items-container">
                <div class="grid grid-cols-5 gap-2 mb-2">
                    <input type="text" name="weight[]" placeholder="Weight" class="border rounded p-2" required>
                    <input type="text" name="height[]" placeholder="Height" class="border rounded p-2" required>
                    <input type="text" name="length[]" placeholder="Length" class="border rounded p-2" required>
                    <input type="text" name="width[]" placeholder="Width" class="border rounded p-2" required>
                    <input type="text" name="price[]" placeholder="Price" class="border rounded p-2" required>
                </div>
            </div>
            <button type="button" onclick="addItem()"
                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mb-4">Add Item</button>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save
                    Parcel</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            function addItem() {
                const container = document.getElementById('items-container');
                const item = document.createElement('div');
                item.classList.add('grid', 'grid-cols-5', 'gap-2', 'mb-2');
                item.innerHTML = `
                <input type="text" name="weight[]" placeholder="Weight" class="border rounded p-2" required>
                <input type="text" name="height[]" placeholder="Height" class="border rounded p-2" required>
                <input type="text" name="length[]" placeholder="Length" class="border rounded p-2" required>
                <input type="text" name="width[]" placeholder="Width" class="border rounded p-2" required>
                <input type="text" name="price[]" placeholder="Price" class="border rounded p-2" required>
            `;
                container.appendChild(item);
            }
        </script>
    @endpush








</x-AdminApp-layout>
