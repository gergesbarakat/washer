<x-AdminApp-layout>
    <div class="p-8 max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Create New Parcel</h2>

        <form method="POST" action="{{ route('admin.parcels.store') }}" class="space-y-6">
            @csrf

            {{-- Hotel / Branch / Courier / Status --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="hotel_id" class="block text-sm font-medium text-gray-700 mb-1">Hotel</label>
                    <select name="hotel_id" id="hotel_id"
                        class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="branch_id" class="block text-sm font-medium text-gray-700 mb-1">Branch</label>
                    <select name="branch_id" id="branch_id"
                        class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="courier_id" class="block text-sm font-medium text-gray-700 mb-1">Courier</label>
                    <select name="courier_id" id="courier_id"
                        class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($couriers as $courier)
                            <option value="{{ $courier->id }}">{{ $courier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="pending">Pending</option>
                        <option value="in_transit">In Transit</option>
                        <option value="delivered">Delivered</option>
                    </select>
                </div>
            </div>

            {{-- Product Search --}}
            <div>
                <label for="productSearch" class="block text-sm font-medium text-gray-700 mb-1">Search Products</label>
                <input type="text" id="productSearch" placeholder="Type to search products..."
                    class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <ul id="productResults"
                    class="hidden border border-gray-300 bg-white rounded-lg mt-1 shadow max-h-60 overflow-y-auto z-10 relative">
                </ul>
            </div>

            {{-- Product Table --}}
            <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
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
                    </tbody>
                </table>
            </div>

            {{-- Submit --}}
            <div class="text-right">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-sm transition duration-150">
                    Save Parcel
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
        document.getElementById('parcel-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            fetch("{{ route('admin.parcels.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token'),
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    const alert = document.getElementById('form-alert');
                    if (data.success) {
                        alert.textContent = 'Parcel saved successfully.';
                        alert.className = 'text-green-600';
                        form.reset();
                        // Optional: redirect or update UI
                    } else {
                        alert.textContent = data.message || 'Failed to save parcel.';
                        alert.className = 'text-red-600';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('form-alert').textContent = 'Something went wrong.';
                    document.getElementById('form-alert').className = 'text-red-600';
                });
        });
    </script>
</x-AdminApp-layout>
