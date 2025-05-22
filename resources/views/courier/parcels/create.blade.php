<x-CourierApp-layout>
    <div class="p-8 max-w-6xl mx-auto bg-white rounded">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">إنشاء طرد جديد</h2>

        <form method="POST" action="{{ route('courier.parcels.store') }}" class="space-y-6" id="parcel-form">
            @csrf

            {{-- الفندق / الفرع / الناقل / الحالة --}}
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
                    <select id="branch_id" disabled
                        class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    </select>
                    <input type="hidden" id="branch_id" name="branch_id" value="{{ $branch->id }}"
                        class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

                <div>
                    <label for="courier_id" class="block text-sm font-medium text-gray-700 mb-1">الناقل</label>
                    <select id="courier_id" disabled
                        class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="{{ $courier->id }}">{{ $courier->name }}</option>
                    </select>
                    <input type="hidden" id="courier_id" name="courier_id" value="{{ $courier->id }}"
                        class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">الحالة</label>
                    <input type="hidden" id="status" name="status" value="pending"
                        class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

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
<button type="submit" id="showModalBtn"
    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
    تأكيد الطرد
</button>

</div>
        </form>
    </div>
<!-- Confirmation Modal -->
<div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-xl max-w-3xl w-full p-6 space-y-6 relative">
        <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">تأكيد تفاصيل الطرد</h3>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><strong>الفندق:</strong> <span id="confirmHotel"></span></div>
            <div><strong>الفرع:</strong> {{ $branch->name }}</div>
            <div><strong>الناقل:</strong> {{ $courier->name }}</div>
            <div><strong>الحالة:</strong> <span class="text-yellow-600 font-semibold">معلق</span></div>
        </div>

        <div>
            <h4 class="text-sm font-semibold text-gray-700 mt-4 mb-2">المنتجات</h4>
            <div class="overflow-x-auto border rounded">
                <table class="min-w-full text-sm text-gray-700 border" id="modalProductTable">
                    <thead class="bg-gray-100 text-xs font-semibold text-gray-800">
                        <tr>
                            <th class="px-4 py-2">المنتج</th>
                            <th class="px-4 py-2">الفئة</th>
                            <th class="px-4 py-2">الكمية</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">لا توجد منتجات</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex justify-end space-x-2 pt-4 border-t">
            <button type="button" id="cancelModal"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-gray-800">إلغاء</button>
            <button type="button" id="confirmSubmit"
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">تأكيد وحفظ</button>
        </div>
    </div>
</div>

<script>
    const form = document.getElementById('parcel-form');
    const modal = document.getElementById('confirmationModal');
    const confirmHotel = document.getElementById('confirmHotel');
    const modalTableBody = document.querySelector('#modalProductTable tbody');

    const cancelModalBtn = document.getElementById('cancelModal');
    const confirmSubmitBtn = document.getElementById('confirmSubmit');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Set hotel name in modal
        const hotelName = document.querySelector('#hotel_id option:checked')?.textContent || '';
        confirmHotel.textContent = hotelName;

        // Copy table rows
        const currentRows = document.querySelectorAll('#productTable tbody tr');
        modalTableBody.innerHTML = '';

        if (currentRows.length === 0) {
            modalTableBody.innerHTML = `<tr><td colspan="3" class="text-center py-4 text-gray-500">لا توجد منتجات</td></tr>`;
        } else {
            currentRows.forEach(row => {
                const cols = row.querySelectorAll('td');
                if (cols.length >= 3) {
                    const productName = cols[0].innerText.trim();
                    const category = cols[1].innerText.trim();
                    const quantity = cols[2].querySelector('input')?.value || '';

                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td class="px-4 py-2 border">${productName}</td>
                        <td class="px-4 py-2 border">${category}</td>
                        <td class="px-4 py-2 border text-center">${quantity}</td>
                    `;
                    modalTableBody.appendChild(newRow);
                }
            });
        }

        // Show modal
        modal.classList.remove('hidden');
    });

    cancelModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    confirmSubmitBtn.addEventListener('click', () => {
        form.removeEventListener('submit', preventDefaultSubmit); // Optional safety
        form.submit();
    });

    // helper to cancel submit default again if needed
    function preventDefaultSubmit(e) {
        e.preventDefault();
    }
</script>

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
                    `{{ url('/courier/products/search') }}?q=${encodeURIComponent(query)}&user_id=${encodeURIComponent(userId)}`
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
                                `${product.name} (${product.category.name})  `;
                            li.dataset.id = product.id;
                            li.dataset.name = product.name;
 
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

                <td class="px-6 py-3">
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
                    `{{ url('/courier/products/search') }}?q=&user_id=${encodeURIComponent(hotelId)}`
                )
                .then(res => res.json())
                .then(products => {
                    productSelect.innerHTML = `<option value="">اختر منتجًا...</option>`;
                    products.forEach(product => {
                        const option = document.createElement('option');
                        option.value = product.id;
                        option.textContent =
                            `${product.name} (${product.category.name})  `;
                        option.dataset.name = product.name;
                        option.dataset.category = product.category.name;
 
                        productSelect.appendChild(option);
                    });
                });
        });
    </script>
</x-CourierApp-layout>
