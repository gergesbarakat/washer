<x-AdminApp-layout>
    <div class="max-w-xl mx-auto p-10 rounded bg-white">
        <h2 class="text-2xl font-bold mb-6">
            {{ isset($category) ? 'تعديل التصنيف' : 'إضافة تصنيف' }}
        </h2>

        <form method="POST" action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
            @csrf
            @if(isset($category))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">الاسم</label>
                <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('name', $category->name ?? '') }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">الوصف</label>
                <textarea name="description" class="w-full p-3 border-gray-300 rounded-md shadow-sm" rows="3">{{ old('description', $category->description ?? '') }}</textarea>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.categories.index') }}" class="mr-2 px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">إلغاء</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    {{ isset($category) ? 'تحديث' : 'إنشاء' }}
                </button>
            </div>
        </form>
    </div>
</x-AdminApp-layout>
