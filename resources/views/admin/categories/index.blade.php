<x-AdminApp-layout>
    <div class="max-w-6xl mx-auto p-8 rounded bg-white">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">التصنيفات</h2>
            <a href="{{ route('admin.categories.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">إضافة تصنيف</a>
        </div>

        <button id="generate-pdf" data-id="invoice-table" data-type="table"
            class="generate-pdf bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
            إنشاء PDF
        </button>
        <button onclick="exportToExcel()"
            class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
            تصدير إلى Excel
        </button>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white p-5">
            <table class="min-w-full table-auto" id="invoice-table">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">الاسم</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">الوصف</th>
                        <th class="p-4 border text-xs font-medium text-gray-500 uppercase">الحالة</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 px-4 py-2">
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td
                                class="px-4 py-2 font-sans text-xs font-bold {{ $category->status == '0' ? 'text-red-500' : 'text-green-500' }} uppercase rounded-md select-none whitespace-nowrap">
                                {{ $category->status == '1' ? 'مفعل' : 'غير مفعل' }}
                            </td>
                            <td class="space-x-2 flex">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                    تعديل
                                </a>
                                @if ($category->status)
                                    <!-- Deactivate Button -->
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد أنك تريد إلغاء تفعيل هذا التصنيف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
                                            إلغاء التفعيل
                                        </button>
                                    </form>
                                @else
                                    <!-- Activate Button -->
                                    <form action="{{ route('admin.categories.activate', $category->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('هل أنت متأكد أنك تريد تفعيل هذا التصنيف؟');">
                                        @csrf
                                        <button type="submit"
                                            class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                                            تفعيل
                                        </button>
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
