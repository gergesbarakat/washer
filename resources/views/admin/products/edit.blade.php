<x-AdminApp-layout>
    <div class="max-w-4xl mx-auto py-8 rounded  bg-white">
        <h2 class="text-2xl font-bold mb-6">Edit Product</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="user_id" class="block font-medium mb-1">Hotel (User)</label>
                <select name="user_id" id="user_id" class="w-full border-gray-300 rounded">
                    <option value="">Select a Hotel</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected($product->user_id == $user->id)>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block font-medium mb-1">Category</label>
                <select name="category_id" id="category_id" class="w-full border-gray-300 rounded">
                    <option value="">Select a Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Name</label>
                <input type="text" name="name" value="{{ $product->name }}" class="w-full border-gray-300 rounded"
                    required>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full border-gray-300 rounded">{{ $product->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Price</label>
                <input type="number" step="0.01" name="price" value="{{ $product->price }}"
                    class="w-full border-gray-300 rounded" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        </form>
    </div>
</x-AdminApp-layout>
