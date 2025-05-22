<x-App-layout>
    <div class="p-6 max-w-6xl mx-auto bg-white rounded">


        <button id="generate-pdf" data-id="invoice-table" data-type="table"
            class="generate-pdf bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">إنشاء
            ملف PDF</button>
        <button onclick="exportToExcel()"
            class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">تصدير
            إلى إكسل</button>

        <table class="min-w-full table-auto" id="invoice-table">
            <thead class="bg-blue-100">
                <tr>
                    <th class="px-4 py-2">الرقم</th>
                    <th class="px-4 py-2" id="Hotel">الفندق</th>
                    <th class="px-4 py-2" id="Branch">الفرع</th>
                    <th class="px-4 py-2">المندوب</th>
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
                        <td class="px-4 py-2">{{ $parcel->created_at->format('Y-m-d H:i:s') }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <button onclick="viewParcel({{ $parcel->id }})"
                                class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">👁
                                عرض</button>
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

    <!-- نافذة مودال -->
    <div id="parcelModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 overflow-y-auto">
        <div class="flex min-h-screen items-center justify-center px-4 py-12">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative animate-fadeIn">
                <button onclick="closeModal()"
                    class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-2xl font-bold">&times;</button>
                <button id="generate-pdf" data-id="parcel" data-type="invoice" data=''
                    class="generate-pdf parcel bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">إنشاء
                    ملف PDF</button>
                <h2 class="text-2xl font-bold text-blue-700 mb-4 border-b pb-2">تفاصيل الطرد</h2>

                <div id="parcel" class="w-full">
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
                            <p class="font-semibold text-gray-900">المندوب:</p>
                            <p id="modalCourier" class="mt-1 text-gray-600">—</p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">الحالة:</p>
                            <p id="modalStatus" class="mt-1 text-gray-600">—</p>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mb-2">عناصر الطرد</h3>
                    <div id="parcelItems" class="space-y-2 max-h-60 overflow-y-auto pr-2">
                        <!-- سيتم إضافة العناصر هنا ديناميكياً -->
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

    <!-- تمرير بيانات الطرد إلى جافاسكريبت -->
    <script>
        $.fn.dataTable.ext.search.push(
            function(settings, searchData, index, rowData, counter) {
                var position = $("#Hotel option:selected").text();
                var office = $("#Branch option:selected").text();

                if (position.length === 0 && office.length === 0) {
                    return true;
                }

                hasPosition = true;
                if (position !== searchData[1]) {
                    hasPosition = false;
                }

                hasOffice = true;
                if (office !== searchData[2]) {
                    hasOffice = false;
                }

                return true ? hasPosition || hasOffice : false;
            });
        const parcels = @json($parcels);

        function viewParcel(parcelId) {
            const parcel = parcels.find(p => p.id === parcelId);
            if (!parcel) return;

            document.getElementById('modalHotel').textContent = parcel.hotel?.name || 'N/A';
            document.getElementById('modalBranch').textContent = parcel.branch?.name || 'N/A';
            document.getElementById('modalCourier').textContent = parcel.courier?.name || 'N/A';
            document.getElementById('modalStatus').textContent = parcel.status || 'N/A';
            document.querySelector('.generate-pdf.parcel').setAttribute('data', parcelId);

            const itemsContainer = document.getElementById('parcelItems');
            itemsContainer.innerHTML = '';

            if (parcel.items && parcel.items.length > 0) {
                parcel.items.forEach(item => {
                    const div = document.createElement('div');
                    div.className = "border px-4 py-2 rounded bg-gray-50";
                    div.innerHTML = `
                        <div class="flex justify-between items-center">
                            <div>
                                <strong>${item.product?.name || 'منتج بدون اسم'}</strong>
                                <p class="text-sm text-gray-600">الكمية: ${item.quantity ?? 0}</p>
                            </div>
                        </div>
                    `;
                    itemsContainer.appendChild(div);
                });
            } else {
                itemsContainer.innerHTML = '<p class="text-gray-500">لا توجد عناصر لهذا الطرد.</p>';
            }

            document.getElementById('parcelModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('parcelModal').classList.add('hidden');
        }
    </script>


    </x-AdminApp-layout>
