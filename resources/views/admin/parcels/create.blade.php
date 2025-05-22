<x-AdminApp-layout>
    <div class="p-8 max-w-6xl mx-auto bg-white rounded">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">إنشاء طرد جديد</h2>

        <form method="POST" action="{{ route('admin.parcels.store') }}" class="space-y-6" id="parcel-form">
            @csrf

            {{-- الفندق / الفرع / المرسل / الحالة --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="hotel_id" class="block text-sm font-medium text-gray-700 mb-1">الفندق</label>
                    <select name="hotel_id" id="hotel_id"
                        class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">اختر الفندق.........</option>

                        @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="branch_id" class="block text-sm font-medium text-gray-700 mb-1">الفرع</label>
                    <select name="branch_id" id="branch_id"
                        class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="courier_id" class="block text-sm font-medium text-gray-700 mb-1">المرسل</label>
                    <select name="courier_id" id="courier_id"
                        class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($couriers as $courier)
                            <option value="{{ $courier->id }}">{{ $courier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">الحالة</label>
                    <select name="status" id="status"
                        class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="pending">قيد الانتظار</option>
                        <option value="in_transit">قيد النقل</option>
                        <option value="delivered">تم التوصيل</option>
                    </select>
                </div>
            </div>
            {{-- قائمة المنتجات (يتم تحميلها بواسطة AJAX بناءً على الفندق) --}}
            <div class="mt-4">
                <label for="productSelect" class="block text-sm font-medium text-gray-700 mb-1">اختر المنتج</label>
                <select id="productSelect"
                    class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">اختر الفندق أولاً...</option>
                </select>
            </div>

            {{-- بحث المنتجات --}}
            <div>
                <label for="productSearch" class="block text-sm font-medium text-gray-700 mb-1">ابحث عن المنتجات</label>
                <input type="text" id="productSearch" placeholder="اكتب للبحث عن المنتجات..."
                    class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <ul id="productResults"
                    class="hidden border border-gray-300 bg-white rounded-lg mt-1 shadow max-h-60 overflow-y-auto z-10 relative">
                </ul>
            </div>

            {{-- جدول المنتجات --}}
            <div class="overflow-x-auto p-4 border border-gray-200 rounded-lg shadow-sm">
                <table id="productTable" class="min-w-full bg-white text-sm text-left text-gray-700">
                    <thead class="bg-gray-100 text-gray-800 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-6 py-3">المنتج</th>
                            <th class="px-6 py-3">الفئة</th>
                            <th class="px-6 py-3">السعر</th>

                            <th class="px-6 py-3">الكمية</th>
                            <th class="px-6 py-3">الإجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            {{-- زر الحفظ --}}
            <div class="text-right">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-sm transition duration-150">
                    حفظ الطرد
                </button>
            </div>
        </form>
    </div>

    {{-- السكربت --}}
    <script>
        const searchInput = document.getElementById('productSearch');
        const resultsList = document.getElementById('productResults');
        const productTableBody = document.querySelector('#productTable tbody');
        const userSelect = document.getElementById('hotel_id');
        const hotelSelect = document.getElementById('hotel_id');
        const productSelect = document.getElementById('productSelect');

        searchInput.addEventListener('keyup', function() {
            const query = this.value.trim();
            const userId = userSelect?.value;

            if (!userId) {
                resultsList.innerHTML =
                    '<li class="px-4 py-2 text-sm text-red-500">يرجى اختيار الفندق أولاً</li>';
                resultsList.classList.remove('hidden');
                return;
            }

            if (query.length < 1) {
                resultsList.classList.add('hidden');
                resultsList.innerHTML = '';
                return;
            }

            fetch(
                    `{{ url('/admin/products/search') }}?q=${encodeURIComponent(query)}&user_id=${encodeURIComponent(userId)}`
                )
                .then(res => res.json())
                .then(products => {
                    resultsList.innerHTML = '';
                    if (products.length === 0) {
                        resultsList.innerHTML =
                            '<li class="px-4 py-2 text-sm text-gray-500">لا توجد نتائج</li>';
                    } else {
                        products.forEach(product => {
                            const li = document.createElement('li');
                            li.className = 'px-4 py-2 hover:bg-blue-100 cursor-pointer';
                            li.textContent =
                                `${product.name} (${product.category.name}) - $${product.price}`;
                            li.dataset.id = product.id;
                            li.dataset.name = product.name;
                            li.dataset.price = product.price;

                            li.dataset.category = product.category.name;
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
                existingRow.remove(); // إزالة الصف إذا كان موجودًا مسبقًا
            }

            const noDataRow = productTableBody.querySelector('.dt-empty');
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

                    <td class="px-6 py-3">${product.price}
                    ريال سعودي </td><td class="px-6 py-3">
                        <input type="number" name="products[${product.id}][quantity]" value="1" min="1" class="w-20 border-gray-300 rounded">
                    </td>
                    <td class="px-6 py-3">
                        <button type="button" class="text-red-500 hover:underline" onclick="this.closest('tr').remove(); checkNoDataRow();">
                            إزالة
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
                    `<td colspan="5" class="text-center px-6 py-3 text-gray-500">لا توجد منتجات مضافة</td>`;
                productTableBody.appendChild(noDataRow);
            }
        };

        productSelect.addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            if (!selected.value) return;

            const product = {
                id: selected.value,
                name: selected.dataset.name,
                category: {
                    name: selected.dataset.category
                },
                price: selected.dataset.price
            };

            addProductRow(product);
            this.value = ''; // إعادة تعيين الاختيار
        });

        hotelSelect.addEventListener('change', () => {
            const hotelId = hotelSelect.value;
            $('tbody tr').remove()
            const noDataRow = document.createElement('tr');
            noDataRow.className = 'no-data';
            noDataRow.innerHTML =
                `<tr><td colspan="5" class="text-center dt-empty px-6 py-3 text-gray-500">لا توجد منتجات مضافة</td></tr>`;
            productTableBody.appendChild(noDataRow);

            productSelect.innerHTML = `<option value="">جارٍ التحميل...</option>`;

            if (!hotelId) {
                productSelect.innerHTML = `<option value="">اختر فندقًا أولاً</option>`;
                return;
            }

            fetch(
                    `{{ url('/admin/products/search') }}?q=&user_id=${encodeURIComponent(hotelId)}`
                )
                .then(res => res.json())
                .then(products => {
                    productSelect.innerHTML = `<option value="">اختر منتجًا...</option>`;
                    products.forEach(product => {
                        const option = document.createElement('option');
                        option.value = product.id;
                        option.textContent =
                            `${product.name} (${product.category.name}) - ريال سعودي${product.price}`;
                        option.dataset.name = product.name;
                        option.dataset.category = product.category.name;
                        option.dataset.price = product.price;

                        productSelect.appendChild(option);
                    });
                });
        });
    </script>
</x-AdminApp-layout>
