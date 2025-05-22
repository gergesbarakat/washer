<x-AdminApp-layout>
    <div class="max-w-6xl mx-auto p-8 bg-white rounded">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">المنتجات</h2>
            <a href="{{ route('admin.products.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">إضافة منتج</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <button id="generate-pdf" data-id="invoice-table" data-type="table"
            class="generate-pdf bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">إنشاء
            ملف PDF</button>
        <button onclick="exportToExcel()"
            class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">تصدير
            إلى إكسل</button>

        <div class="overflow-x-auto bg-white p-5 ">
            <table class="min-w-full table-auto " id="invoice-table">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">الاسم</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">التصنيف</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">الفندق</th>

                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">السعر</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">الحالة</th>

                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr>
                            <td class="px-4 py-2">{{ $product->name }}</td>
                            <td class="px-4 py-2">{{ $product->category->name ?? 'غير متوفر' }}</td>
                            <td class="px-4 py-2">{{ $product->user->name ?? 'غير متوفر' }}</td>

                            <td class="px-4 py-2">{{ number_format($product->price, 2) }}</td>

                            <td
                                class="px-4 py-2 font-sans text-xs font-bold {{ $product->status == '0' ? 'text-red-500' : 'text-green-500' }} uppercase rounded-md select-none whitespace-nowrap ">
                                {{ $product->status == '1' ? 'مفعل' : 'معطل' }}
                            </td>
                            <td class="px-4 py-2 flex space-x-2">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">تعديل</a>
                                @if ($product->status)
                                    <!-- زر التعطيل -->
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد أنك تريد تعطيل هذا المنتج؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">تعطيل</button>
                                    </form>
                                @else
                                    <!-- زر التفعيل -->
                                    <form action="{{ route('admin.products.activate', $product->id) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد أنك تريد تفعيل هذا المنتج؟');">
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
</x-AdminApp-layout>
