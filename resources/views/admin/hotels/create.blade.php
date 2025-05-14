<x-AdminApp-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Add Hotel</h1>

        <form action="{{ route('admin.hotels.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block mb-1 font-semibold">Hotel Name</label>
                <input type="text" name="name" id="name" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block mb-1 font-semibold">Email</label>
                <input type="email" name="email" id="email" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-1 font-semibold">Password</label>
                <input type="password" name="password" id="password" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block mb-1 font-semibold">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label for="street" class="block mb-1 font-semibold">Street</label>
                <input type="text" name="street" id="street" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label for="city" class="block mb-1 font-semibold">City</label>
                <input type="text" name="city" id="city" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label for="state" class="block mb-1 font-semibold">State</label>
                <input type="text" name="state" id="state" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label for="zip_code" class="block mb-1 font-semibold">Zip Code</label>
                <input type="text" name="zip_code" id="zip_code" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label for="country" class="block mb-1 font-semibold">Country</label>
                <input type="text" name="country" id="country" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label for="contact" class="block mb-1 font-semibold">Contact</label>
                <input type="text" name="contact" id="contact" class="w-full border rounded p-2">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Hotel</button>
        </form>
    </div>
</x-AdminApp-layout>
