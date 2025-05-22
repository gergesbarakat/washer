<x-AdminApp-layout>
    <div class="container mx-auto p-6 rounded bg-white max-w-4xl">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">تعديل الفرع</h1>

        <form action="{{ route('admin.branches.update', $branch) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Branch Name --}}
            <div>
                <label class="block mb-1 font-medium text-gray-700">اسم الفرع</label>
                <input type="text" name="name" value="{{ old('name', $branch->name) }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Address Fields --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach (['street' => 'الشارع', 'city' => 'المدينة', 'state' => 'المنطقة', 'zip_code' => 'الرمز البريدي'] as $field => $label)
                    <div>
                        <label class="block mb-1 font-medium text-gray-700">{{ $label }}</label>
                        <input type="text" name="{{ $field }}" value="{{ old($field, $branch->$field) }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error($field)
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>

            {{-- Country & Contact --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach (['country' => 'الدولة', 'contact' => 'رقم التواصل'] as $field => $label)
                    <div>
                        <label class="block mb-1 font-medium text-gray-700">{{ $label }}</label>
                        <input type="text" name="{{ $field }}" value="{{ old($field, $branch->$field) }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error($field)
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>

            {{-- Submit Button --}}
            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                    تحديث الفرع
                </button>
            </div>
        </form>
    </div>
</x-AdminApp-layout>
