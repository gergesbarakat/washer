<x-AdminApp-layout>
    <div class="max-w-3xl mx-auto py-10 rounded bg-white">
        <div class="bg-white shadow-lg rounded-xl p-8">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">إضافة منتج جديد</h2>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-300 text-red-700 p-4 rounded mb-6">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">الفندق (المستخدم)</label>
                    <select name="user_id" id="user_id"
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                        <option value="">-- اختر فندقًا --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">التصنيف</label>
                    <select name="category_id" id="category_id"
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                        <option value="">-- اختر تصنيفًا --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">اسم المنتج</label>
                    <input type="text" name="name" id="name"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">الوصف</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">السعر ($)</label>
                    <input type="number" step="0.01" name="price" id="price"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                        حفظ المنتج
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-AdminApp-layout>
