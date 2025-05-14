<x-AdminApp-layout>
    <div class="p-8 max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Edit Parcel</h2>

        <form method="POST" action="{{ route('admin.parcels.update', $parcel->id) }}" id="parcel-form" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Hotel / Branch / Courier / Status --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="hotel_id" class="block text-sm font-medium text-gray-700 mb-1">Hotel</label>
                    <select name="hotel_id" id="hotel_id"
                        class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->id }}" @if($hotel->id === $parcel->hotel_id) selected @endif>
                                {{ $hotel->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="branch_id" class="block text-sm font-medium text-gray-700 mb-1">Branch</label>
                    <select name="branch_id" id="branch_id"
                        class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}" @if($branch->id === $parcel->branch_id) selected @endif>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="courier_id" class="block text-sm font-medium text-gray-700 mb-1">Courier</label>
                    <select name="courier_id" id="courier_id"
                        class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($couriers as $courier)
                            <option value="{{ $courier->id }}" @if($courier->id === $parcel->courier_id) selected @endif>
                                {{ $courier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="pending" @if($parcel->status === 'pending') selected @endif>Pending</option>
                        <option value="in_transit" @if($parcel->status === 'in_transit') selected @endif>In Transit</option>
                        <option value="delivered" @if($parcel->status === 'delivered') selected @endif>Delivered</option>
                    </select>
                </div>
            </div>

            {{-- Parcel Item Table --}}
            <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm mt-4">
                <table id="productTable" class="min-w-full bg-white text-sm text-left text-gray-700">
                    <thead class="bg-gray-100 text-gray-800 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-6 py-3">Product</th>
                            <th class="px-6 py-3">Category</th>
                            <th class="px-6 py-3">Price</th>
                            <th class="px-6 py-3">Quantity</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parcel->items as $item)
                            <tr id="product-row-{{ $item->product_id }}">
                                <td class="px-6 py-3">
                                    {{ $item->product->name }}
                                    <input type="hidden" name="products[{{ $item->product_id }}][id]" value="{{ $item->product_id }}">
                                </td>
                                <td class="px-6 py-3">{{ $item->product->category->name }}</td>
                                <td class="px-6 py-3">${{ $item->product->price }}</td>
                                <td class="px-6 py-3">
                                    <input type="number" name="products[{{ $item->product_id }}][quantity]" value="{{ $item->quantity }}" min="1" class="w-20 border-gray-300 rounded">
                                </td>
                                <td class="px-6 py-3">
                                    <button type="button" class="text-red-500 hover:underline" onclick="this.closest('tr').remove(); checkNoDataRow();">
                                        Remove
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        @if($parcel->items->count() === 0)
                            <tr class="no-data">
                                <td colspan="5" class="text-center px-6 py-3">No products added</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- Product Search --}}
            <div class="mt-4">
                <label for="productSearch" class="block text-sm font-medium text-gray-700 mb-1">Search Products</label>
                <input type="text" id="productSearch" placeholder="Type to search products..."
                    class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <ul id="productResults"
                    class="hidden border border-gray-300 bg-white rounded-lg mt-1 shadow max-h-60 overflow-y-auto z-10 relative">
                </ul>
            </div>

            {{-- Submit Button --}}
            <div class="text-right mt-6">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-sm transition duration-150">
                    Update Parcel
                </button>
            </div>
        </form>
    </div>

    {{-- Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('productSearch');
            const resultsList = document.getElementById('productResults');
            const productTableBody = document.querySelector('#productTable tbody');

            searchInput.addEventListener('keyup', function() {
                const query = this.value.trim();
                if (query.length < 1) {
                    resultsList.classList.add('hidden');
                    resultsList.innerHTML = '';
                    return;
                }

                fetch(`{{ url('/admin/products/search') }}?q=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(products => {
                        resultsList.innerHTML = '';
                        if (products.length === 0) {
                            resultsList.innerHTML =
                                '<li class="px-4 py-2 text-sm text-gray-500">No results found</li>';
                        } else {
                            products.forEach(product => {
                                const li = document.createElement('li');
                                li.className = 'px-4 py-2 hover:bg-blue-100 cursor-pointer';
                                li.textContent =
                                    `${product.name} (${product.category.name}) - $${product.price}`;
                                li.dataset.id = product.id;
                                li.dataset.name = product.name;
                                li.dataset.category = product.category.name;
                                li.dataset.price = product.price;
                                li.addEventListener('click', () => {
                                    addProductRow(product);
                                    resultsList.classList.add('hidden');
                                    searchInput.value = '';
                                });
                                resultsList.appendChild(li);
                            });
                        }
                        resultsList.classList.remove('hidden');
                    });
            });

            function addProductRow(product) {
                const existingRow = document.getElementById(`product-row-${product.id}`);
                if (existingRow) {
                    existingRow.remove(); // Remove if already exists
                }

                // Remove no-data row
                const noDataRow = productTableBody.querySelector('.no-data');
                if (noDataRow) noDataRow.remove();

                const tr = document.createElement('tr');
                tr.id = `product-row-${product.id}`;
                tr.className = 'hover:bg-gray-50';

                tr.innerHTML = `
                    <td class="px-6 py-3">
                        ${product.name}
                        <input type="hidden" name="products[${product.id}][id]" value="${product.id}">
                    </td>
                    <td class="px-6 py-3">${product.category.name}</td>
                    <td class="px-6 py-3">$${product.price}</td>
                    <td class="px-6 py-3">
                        <input type="number" name="products[${product.id}][quantity]" value="1" min="1" class="w-20 border-gray-300 rounded">
                    </td>
                    <td class="px-6 py-3">
                        <button type="button" class="text-red-500 hover:underline" onclick="this.closest('tr').remove(); checkNoDataRow();">
                            Remove
                        </button>
                    </td>
                `;

                productTableBody.appendChild(tr);
            }

            window.checkNoDataRow = function() {
                if (productTableBody.querySelectorAll('tr').length === 0) {
                    const noDataRow = document.createElement('tr');
                    noDataRow.className = 'no-data';
                    noDataRow.innerHTML =
                        `No products added`;
                    productTableBody.appendChild(noDataRow);
                }
            };
        });
    </script>
</x-AdminApp-layout>
