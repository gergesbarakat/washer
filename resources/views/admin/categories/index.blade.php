<x-AdminApp-layout>

    <div class="max-w-6xl mx-auto p-8 rounded bg-white">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Categories</h2>
            <a href="{{ route('admin.categories.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Category</a>
        </div>
        <button id="generate-pdf" data-id="invoice-table" data-type="table"
            class="generate-pdf bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Generate
            PDF</button>
        <button onclick="exportToExcel()"
            class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">Export
            to Excel</button>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white   p-5    ">
            <table class="min-w-full table-auto  " id="invoice-table">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="p-4 border">status</th>

                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 px-4 py-2">
                    @foreach ($categories as $category)
                        <tr>
                            <td class=" ">{{ $category->name }}</td>
                            <td class=" ">{{ $category->description }}</td>
                            <td
                            class="px-4 py-2     font-sans text-xs font-bold {{ $category->status == '0' ? 'text-red-500  ' : 'text-green-500  *:' }} uppercase rounded-md select-none whitespace-nowrap ">
                            {{ $category->status == '1' ? 'Activated' : 'DeActivated' }}

                        </td>
                            <td class="  space-x-2 flex">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Edit</a>
                                @if ($category->status)
                                    <!-- Deactivate Button -->
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to deactivate this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">Deactivate</button>
                                    </form>
                                @else
                                    <!-- Activate Button -->
                                    <form action="{{ route('admin.categories.activate', $category->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to activate this category?');">
                                        @csrf
                                        <button type="submit"
                                            class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">Activate</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</x-AdminApp-layout>
