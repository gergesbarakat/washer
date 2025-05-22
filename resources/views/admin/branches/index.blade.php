<x-AdminApp-layout>
    <div class="container mx-auto bg-white p-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">الفروع</h1>
            <a href="{{ route('admin.branches.create') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition">
                إضافة فرع
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <button id="generate-pdf" data-id="invoice-table" data-type="table"
            class="generate-pdf bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
            إنشاء PDF
        </button>

        <button onclick="exportToExcel()"
            class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
            تصدير إلى Excel
        </button>

        <div class="overflow-x-auto bg-white p-5">
            <table class="min-w-full table-auto" id="invoice-table">
                <thead>
                    <tr class="bg-blue-100 text-gray-800 text-sm font-semibold uppercase">
                        <th class="p-4">الاسم</th>
                        <th class="p-4">الشارع</th>
                        <th class="p-4">المدينة</th>
                        <th class="p-4">المنطقة</th>
                        <th class="p-4">الرمز البريدي</th>
                        <th class="p-4">الدولة</th>
                        <th class="p-4">التواصل</th>
                        <th class="p-4">الحالة</th>
                        <th class="p-4">تاريخ الإضافة</th>
                        <th class="p-4">آخر تحديث</th>
                        <th class="p-4">الخيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($branches as $branch)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4">{{ $branch->name }}</td>
                            <td class="p-4">{{ $branch->street }}</td>
                            <td class="p-4">{{ $branch->city }}</td>
                            <td class="p-4">{{ $branch->state }}</td>
                            <td class="p-4">{{ $branch->zip_code }}</td>
                            <td class="p-4">{{ $branch->country }}</td>
                            <td class="p-4">{{ $branch->contact }}</td>
                            <td
                                class="px-4 py-2 relative grid items-center px-2 py-1 font-sans text-xs font-bold {{ $branch->status == '0' ? 'text-red-900 bg-red-500/20' : 'text-green-900 bg-green-500/20' }} uppercase rounded-md select-none whitespace-nowrap">
                                {{ $branch->status == '1' ? 'مفعل' : 'غير مفعل' }}
                            </td>
                            <td class="p-4">
                                {{ $branch->created_at->format('M d, Y') }}
                            </td>
                            <td class="p-4">
                                {{ $branch->updated_at->format('M d, Y') }}
                            </td>
                            <td class="p-5 flex space-x-2">
                                <a href="{{ route('admin.branches.edit', $branch) }}"
                                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                    تعديل
                                </a>
                                @if ($branch->status)
                                    <!-- Deactivate Button -->
                                    <form action="{{ route('admin.branches.destroy', $branch->id) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد أنك تريد إلغاء تفعيل هذا الفرع؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
                                            إلغاء التفعيل
                                        </button>
                                    </form>
                                @else
                                    <!-- Activate Button -->
                                    <form action="{{ route('admin.branches.activate', $branch->id) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد أنك تريد تفعيل هذا الفرع؟');">
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
