<x-AdminApp-layout>
    <div class="container mx-auto px-4 py-6 bg-white rounded shadow max-w-4xl">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Add Hotel</h1>

        <form action="{{ route('admin.hotels.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Name and Email --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block mb-1 font-semibold text-gray-700">Hotel Name</label>
                    <input type="text" name="name" id="name" class="w-full border rounded px-4 py-2" required>
                </div>
                <div>
                    <label for="email" class="block mb-1 font-semibold text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="w-full border rounded px-4 py-2" required>
                </div>
            </div>

            {{-- Passwords --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block mb-1 font-semibold text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="w-full border rounded px-4 py-2" required>
                </div>
                <div>
                    <label for="password_confirmation" class="block mb-1 font-semibold text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded px-4 py-2" required>
                </div>
            </div>

            {{-- Address Fields --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="street" class="block mb-1 font-semibold text-gray-700">Street</label>
                    <input type="text" name="street" id="street" class="w-full border rounded px-4 py-2">
                </div>
                <div>
                    <label for="city" class="block mb-1 font-semibold text-gray-700">City</label>
                    <input type="text" name="city" id="city" class="w-full border rounded px-4 py-2">
                </div>
                <div>
                    <label for="state" class="block mb-1 font-semibold text-gray-700">State</label>
                    <input type="text" name="state" id="state" class="w-full border rounded px-4 py-2">
                </div>
                <div>
                    <label for="zip_code" class="block mb-1 font-semibold text-gray-700">Zip Code</label>
                    <input type="text" name="zip_code" id="zip_code" class="w-full border rounded px-4 py-2">
                </div>
                <div>
                    <label for="country" class="block mb-1 font-semibold text-gray-700">Country</label>
                    <input type="text" name="country" id="country" class="w-full border rounded px-4 py-2">
                </div>
                <div>
                    <label for="contact" class="block mb-1 font-semibold text-gray-700">Contact</label>
                    <input type="text" name="contact" id="contact" class="w-full border rounded px-4 py-2">
                </div>
            </div>

            {{-- Submit --}}
            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                    Save Hotel
                </button>
            </div>
        </form>
    </div>
</x-AdminApp-layout>
