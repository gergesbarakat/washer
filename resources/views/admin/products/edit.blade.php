<div class="max-w-xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">
        {{ isset($product) ? 'Edit Product' : 'Add Product' }}
    </h2>

    <form method="POST" action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Name</label>
            <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('name', $product->name ?? '') }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Category</label>
            <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Price</label>
            <input type="number" step="0.01" name="price" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('price', $product->price ?? '') }}" required>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.products.index') }}" class="mr-2 px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                {{ isset($product) ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>
</div>
