<x-AdminApp-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Edit Hotel</h1>

        <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block mb-1 font-semibold">Hotel Name</label>
                <input type="text" name="name" id="name" value="{{ $hotel->name }}" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block mb-1 font-semibold">Email</label>
                <input type="email" name="email" id="email" value="{{ $hotel->email }}" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-1 font-semibold">New Password (leave blank to keep current)</label>
                <input type="password" name="password" id="password" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block mb-1 font-semibold">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label for="street" class="block mb-1 font-semibold">Street</label>
                <input type="text" name="street" id="street" value="{{ $hotel->street }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label for="city" class="block mb-1 font-semibold">City</label>
                <input type="text" name="city" id="city" value="{{ $hotel->city }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label for="state" class="block mb-1 font-semibold">State</label>
                <input type="text" name="state" id="state" value="{{ $hotel->state }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label for="zip_code" class="block mb-1 font-semibold">Zip Code</label>
                <input type="text" name="zip_code" id="zip_code" value="{{ $hotel->zip_code }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label for="country" class="block mb-1 font-semibold">Country</label>
                <input type="text" name="country" id="country" value="{{ $hotel->country }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label for="contact" class="block mb-1 font-semibold">Contact</label>
                <input type="text" name="contact" id="contact" value="{{ $hotel->contact }}" class="w-full border rounded p-2">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Hotel</button>
        </form>
    </div>
</x-AdminApp-layout>
