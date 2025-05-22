<x-AdminApp-layout>
    <div class="p-6 max-w-6xl mx-auto bg-white rounded">
        <div class="flex w-full justify-between items-center mb-6 ">

            <h1 class="text-2xl font-bold mb-4">الطرود</h1>

            <a href="{{ route('admin.parcels.create') }}"
                class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                + طرد جديد
            </a>

        </div>
        <button id="generate-pdf" data-id="invoice-table" data-type="table"
            class="generate-pdf bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">توليد
            ملف PDF</button>
        <button onclick="exportToExcel()"
            class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">تصدير
            إلى Excel</button>

        <table class="min-w-full table-auto  " id="invoice-table">
            <thead class="bg-blue-100">

                <tr>
                    <th class="px-4 py-2">المعرف</th>
                    <th class="px-4 py-2" id="Hotel">الفندق</th>
                    <th class="px-4 py-2" id="Branch">الفرع</th>
                    <th class="px-4 py-2">الموصل</th>

                    <th class="px-4 py-2">الحالة</th>

                    <th class="px-4 py-2">تاريخ الإنشاء</th>
                    <th class="px-4 py-2">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($parcels as $parcel)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $parcel->id }}</td>
                        <td class="px-4 py-2">{{ $parcel->hotel->name }}</td>
                        <td class="px-4 py-2">{{ $parcel->branch->name }}</td>
                        <td class="px-4 py-2">{{ $parcel->courier->name ?? '—' }}</td>
                        <td
                            class="px-4 py-2 relative grid items-center px-2 py-1 font-sans text-xs font-bold {{ $parcel->status == 'delivered' ? 'text-green-900 bg-green-500/20' : ($parcel->status == 'canceled' ? 'text-red-900 bg-red-500/20' : 'text-gray-900 bg-gray-500/20') }} uppercase rounded-md select-none whitespace-nowrap ">

                            {{ $parcel->status }}
                        </td>
                        <td class="px-4 py-2">{{ $parcel->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <button onclick="viewParcel({{ $parcel->id }})"
                                class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">👁
                                عرض</button>
                            <a href="{{ route('admin.parcels.edit', $parcel->id) }}"
                                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">تعديل</a>
                            <form class="inline-block" method="POST"
                                action="{{ route('admin.parcels.destroy', $parcel->id) }}"
                                onsubmit="return confirm('هل أنت متأكد من حذف هذا الطرد؟')">
                                @csrf @method('DELETE')
                                <button
                                    class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded"
                                    type="submit">إلغاء</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center px-4 py-6 text-gray-500">لا توجد طرود.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="parcelModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 overflow-y-auto">
        <div class="flex min-h-screen items-center justify-center px-4 py-12">

            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative animate-fadeIn">
                <button onclick="closeModal()"
                    class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-2xl font-bold">&times;</button>
                <button id="generate-pdf" data-id="parcel" data-type="invoice"
                    class="generate-pdf bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">توليد
                    ملف PDF</button>
                <h2 class="text-2xl font-bold text-blue-700 mb-4 border-b pb-2">تفاصيل الطرد</h2>

                <div id="parcel">

                    <div class="grid grid-cols-2 gap-4 mb-6 text-sm text-gray-700">
                        <div>
                            <p class="font-semibold text-gray-900">الفندق:</p>
                            <p id="modalHotel" class="mt-1 text-gray-600">—</p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">الفرع:</p>
                            <p id="modalBranch" class="mt-1 text-gray-600">—</p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">الموصل:</p>
                            <p id="modalCourier" class="mt-1 text-gray-600">—</p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">الحالة:</p>
                            <p id="modalStatus" class="mt-1 text-gray-600">—</p>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mb-2">عناصر الطرد</h3>
                    <div id="parcelItems" class="space-y-2 max-h-60 overflow-y-auto pr-2">
                        <!-- العناصر سيتم إضافتها ديناميكياً -->
                    </div>

                    <div class="text-right mt-4 border-t pt-3">
                        <p class="text-base font-semibold text-gray-700">السعر الإجمالي: <span id="totalPrice"
                                class="text-blue-600">—</span></p>
                    </div>

                </div>
                <div class="text-right mt-6">
                    <button onclick="closeModal()"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded">
                        إغلاق
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pass parcel data to JS -->
    <script>
        $.fn.dataTable.ext.search.push(
            function(settings, searchData, index, rowData, counter) {
                var position = $("#Hotel option:selected").text();
                var office = $("#Branch option:selected").text();

                // عرض الصف إذا كانت كلا الخانتين فارغة
                if (position.length === 0 && office.length === 0) {
                    return true;
                }

                // عرض الصف إذا تطابق الموقع مع الاختيار
                hasPosition = true;

                if (position !== searchData[1]) {
                    hasPosition = false; // لا يطابق - لا تعرض
                }

                // عرض الصف إذا تطابق المكتب مع الاختيار
                hasOffice = true;

                if (office !== searchData[2]) {
                    hasOffice = false; // لا يطابق - لا تعرض
                }

                // إذا تطابق الموقع أو المكتب عرض الصف
                return true ? hasPosition || hasOffice : false;
            });
        const parcels = @json($parcels);

        function viewParcel(parcelId) {
            const parcel = parcels.find(p => p.id === parcelId);
            if (!parcel) return;

            document.getElementById('modalHotel').textContent = parcel.hotel?.name || 'غير متوفر';
            document.getElementById('modalBranch').textContent = parcel.branch?.name || 'غير متوفر';
            document.getElementById('modalCourier').textContent = parcel.courier?.name || 'غير متوفر';
            document.getElementById('modalStatus').textContent = parcel.status || 'غير متوفر';

            const itemsContainer = document.getElementById('parcelItems');
            itemsContainer.innerHTML = '';

            let total = 0;

            if (parcel.items && parcel.items.length > 0) {
                parcel.items.forEach(item => {
                    const price = item.price ?? 0;
                    const quantity = item.quantity ?? 0;
                    const subtotal = price * quantity;
                    total += subtotal;

                    const div = document.createElement('div');
                    div.className = "border px-4 py-2 rounded bg-gray-50";
                    div.innerHTML = `
                <div class="flex justify-between items-center">
                    <div>
                        <strong>${item.product?.name || 'منتج غير مسمى'}</strong>
                        <p class="text-sm text-gray-600">الكمية: ${quantity}, سعر الوحدة: ${price}
                        ريال سعودي </p>
                    </div>
                    <div class="font-semibold text-gray-800">المجموع: ${subtotal}
                     ريال سعودي </div>
                </div>
            `;
                    itemsContainer.appendChild(div);
                });
            } else {
                itemsContainer.innerHTML = '<p class="text-gray-500">لا توجد عناصر لهذا الطرد.</p>';
            }

            document.getElementById('totalPrice').textContent = total + 'ريال سعودي';

            document.getElementById('parcelModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('parcelModal').classList.add('hidden');
        }
    </script>
</x-AdminApp-layout>
