<x-AdminApp-layout>
    <div class="container rounded mx-auto px-6 bg-white py-6">
        <div class="flex w-full justify-between items-center mb-6 ">
            <h1 class="text-2xl font-semibold">الفنادق</h1> <a href="{{ route('admin.hotels.create') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition">إضافة فندق</a>
        </div>
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">{{ session('success') }}</div>
        @endif
        <button id="generate-pdf" data-id="invoice-table" data-type="table"
            class="generate-pdf bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">توليد
            PDF</button>
        <button onclick="exportToExcel()"
            class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">تصدير
            إلى Excel</button>

        <div class="overflow-x-auto bg-white   p-5    ">
            <table class="min-w-full table-auto  " id="invoice-table">
                <thead class="bg-blue-100 text-gray-600">
                    <tr class="text-sm font-medium uppercase">
                        <th class="px-6 py-4 text-left s">الاسم</th>
                        <th class="px-6 py-4 text-left s">البريد الإلكتروني</th>
                        <th class="px-6 py-4 text-left s">التواصل</th>
                        <th class="px-6 py-4 text-left s">المدينة</th>
                        <th class="px-6 py-4 text-left s">الولاية</th>
                        <th class="px-6 py-4 text-left s">الرمز البريدي</th>
                        <th class="px-6 py-4 text-left s">البلد</th>
                        <th class="px-6 py-4 text-left s">الحالة</th>

                        <th class="px-6 py-4 text-left s">تاريخ الإنشاء</th>
                        <th class="px-6 py-4 text-left s">تاريخ التحديث</th>
                        <th class="px-6 py-4 text-left s">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hotels as $hotel)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 s">{{ $hotel->name }}</td>
                            <td class="px-6 py-4 s">{{ $hotel->email }}</td>
                            <td class="px-6 py-4 s">{{ $hotel->contact }}</td>
                            <td class="px-6 py-4 s">{{ $hotel->city }}</td>
                            <td class="px-6 py-4 s">{{ $hotel->state }}</td>
                            <td class="px-6 py-4 s">{{ $hotel->zip_code }}</td>
                            <td class="px-6 py-4 s">{{ $hotel->country }}</td>
                            <td
                                class="px-4 py-2 font-sans text-xs font-bold {{ $hotel->status == '0' ? 'text-red-500' : 'text-green-500' }} uppercase rounded-md select-none whitespace-nowrap ">
                                {{ $hotel->status == '1' ? 'مفعل' : 'غير مفعل' }}
                            </td>
                            <td class="px-6 py-4 s">{{ $hotel->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 s">{{ $hotel->updated_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 flex justify-around items-center space-x-4">
                                <a href="{{ route('admin.hotels.edit', $hotel) }}"
                                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">تعديل</a>

                                <button data-url="{{ route('admin.hotels.show', $hotel->id) }}"
                                    data-title="تفاصيل الفندق"
                                    class="bg-transparent show-hotel-details hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                                    عرض
                                </button>
                                @if ($hotel->status)
                                    <form action="{{ route('admin.hotels.destroy', $hotel->id) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد أنك تريد تعطيل هذا الفندق؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">تعطيل</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.hotels.activate', $hotel->id) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد أنك تريد تفعيل هذا الفندق؟');">
                                        @csrf
                                        <button type="submit"
                                            class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">تفعيل</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- نافذة تفاصيل الفندق -->
    <div id="hotel-details-modal"
        class="fixed flex inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <!-- حاوية الإغلاق عند النقر خارج النافذة -->
        <div id="hotel-modal-inner"
            class="bg-white w-full max-w-4xl rounded-2xl shadow-2xl p-6 relative overflow-y-auto max-h-[90vh]">
            <!-- زر الإغلاق -->
            <button id="close-modal"
                class="absolute top-3 right-4 text-gray-400 hover:text-red-500 text-2xl font-bold">&times;</button>
            <button id="generate-pdf" data-id="hotel-details-content" data-type="table"
                class="generate-pdf bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">توليد
                PDF</button>
            <!-- المحتوى الديناميكي -->
            <div id="hotel-details-content">
                <!-- يتم تحميل المحتوى هنا -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('hotel-details-modal');
            const modalInner = document.getElementById('hotel-modal-inner');
            const content = document.getElementById('hotel-details-content');

            // فتح النافذة
            document.querySelectorAll('.show-hotel-details').forEach(button => {
                button.addEventListener('click', function() {
                    const url = this.dataset.url;
                    fetch(url)
                        .then(res => res.json())
                        .then(data => {
                            content.innerHTML = data.html;
                            modal.classList.remove('hidden');
                        });
                });
            });

            // إغلاق عند الضغط على زر X
            document.getElementById('close-modal').addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            // إغلاق عند النقر خارج النافذة
            modal.addEventListener('click', (event) => {
                if (!modalInner.contains(event.target)) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
</x-AdminApp-layout>
