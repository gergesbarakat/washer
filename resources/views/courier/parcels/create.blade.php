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
            {{-- اختيار المنتج (يتم تحميله عبر AJAX بناءً على الفندق) --}}
            <div class="mt-4">
                <label for="productSelect" class="block text-sm font-medium text-gray-700 mb-1">اختر المنتج</label>
                <select id="productSelect"
                    class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">اختر الفندق أولاً...</option>
                </select>
            </div>

            {{-- البحث عن المنتج --}}
            <div>
                <label for="productSearch" class="block text-sm font-medium text-gray-700 mb-1">البحث عن
                    المنتجات</label>
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
                            <th class="px-6 py-3">التصنيف</th>
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

    {{-- السكريبت --}}
    <script>
        // باقي السكريبت يبقى كما هو (لأنه كود جافاسكريبت)
    </script>

</x-CourierApp-layout>
