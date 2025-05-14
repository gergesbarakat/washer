<x-AdminApp-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Branch</h1>

        <form action="{{ route('admin.branches.update', $branch) }}" method="POST">
            @csrf
            @method('PUT')

            @foreach (['name', 'street', 'city', 'state', 'zip_code', 'country', 'contact'] as $field)
                <div class="mb-4">
                    <label class="block mb-1 capitalize">{{ str_replace('_', ' ', $field) }}</label>
                    <input type="text" name="{{ $field }}" class="w-full border rounded p-2"
                           value="{{ old($field, $branch->$field) }}">
                    @error($field)
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Branch</button>
        </form>
    </div>
</x-AdminApp-layout>
