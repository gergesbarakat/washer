<x-AdminApp-layout>
    <div class="container mx-auto px-4 py-6 bg-white rounded shadow max-w-4xl">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">تعديل الفندق</h1>

        <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- الاسم والبريد الإلكتروني --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block mb-1 font-semibold text-gray-700">اسم الفندق</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $hotel->name) }}"
                        class="w-full border rounded px-4 py-2" required>
                </div>
                <div>
                    <label for="email" class="block mb-1 font-semibold text-gray-700">البريد الإلكتروني</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $hotel->email) }}"
                        class="w-full border rounded px-4 py-2" required>
                </div>
            </div>

            {{-- كلمات المرور --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block mb-1 font-semibold text-gray-700">كلمة المرور الجديدة</label>
                    <input type="password" name="password" id="password" class="w-full border rounded px-4 py-2"
                        placeholder="اترك الحقل فارغاً للاحتفاظ بالكلمة الحالية">
                </div>
                <div>
                    <label for="password_confirmation" class="block mb-1 font-semibold text-gray-700">تأكيد كلمة
                        المرور</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full border rounded px-4 py-2">
                </div>
            </div>

            {{-- حقول العنوان --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="street" class="block mb-1 font-semibold text-gray-700">الشارع</label>
                    <input type="text" name="street" id="street" value="{{ old('street', $hotel->street) }}"
                        class="w-full border rounded px-4 py-2">
                </div>
                <div>
                    <label for="city" class="block mb-1 font-semibold text-gray-700">المدينة</label>
                    <input type="text" name="city" id="city" value="{{ old('city', $hotel->city) }}"
                        class="w-full border rounded px-4 py-2">
                </div>
                <div>
                    <label for="state" class="block mb-1 font-semibold text-gray-700">المحافظة</label>
                    <input type="text" name="state" id="state" value="{{ old('state', $hotel->state) }}"
                        class="w-full border rounded px-4 py-2">
                </div>
                <div>
                    <label for="zip_code" class="block mb-1 font-semibold text-gray-700">الرمز البريدي</label>
                    <input type="text" name="zip_code" id="zip_code" value="{{ old('zip_code', $hotel->zip_code) }}"
                        class="w-full border rounded px-4 py-2">
                </div>
                <div>
                    <label for="country" class="block mb-1 font-semibold text-gray-700">الدولة</label>
                    <input type="text" name="country" id="country" value="{{ old('country', $hotel->country) }}"
                        class="w-full border rounded px-4 py-2">
                </div>
                <div>
                    <label for="contact" class="block mb-1 font-semibold text-gray-700">رقم التواصل</label>
                    <input type="text" name="contact" id="contact" value="{{ old('contact', $hotel->contact) }}"
                        class="w-full border rounded px-4 py-2">
                </div>
            </div>

            {{-- إرسال --}}
            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                    تحديث الفندق
                </button>
            </div>
        </form>
    </div>
</x-AdminApp-layout>
