  <x-AdminApp-layout>
      <div class="container mx-auto p-4">
          <div class="flex justify-between items-center mb-6">
              <h1 class="text-3xl font-bold text-gray-800">Branches</h1>
              <a href="{{ route('admin.branches.create') }}"
                  class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition">Add
                  Branch</a>
          </div>

          @if (session('success'))
              <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                  {{ session('success') }}</div>
          @endif

          <div class="overflow-x-auto bg-white shadow rounded-lg border p-5 border-gray-300">
              <table class="min-w-full table-auto">
                  <thead>
                      <tr class="bg-gray-100 text-gray-800 text-sm font-semibold uppercase">
                          <th class="p-4 border">Name</th>
                          <th class="p-4 border">Street</th>
                          <th class="p-4 border">City</th>
                          <th class="p-4 border">State</th>
                          <th class="p-4 border">Zip Code</th>
                          <th class="p-4 border">Country</th>
                          <th class="p-4 border">Contact</th>
                          <th class="p-4 border">Created</th>
                          <th class="p-4 border">Updated</th>
                          <th class="p-4 border">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($branches as $branch)
                          <tr class="hover:bg-gray-50">
                              <td class="p-4 border">{{ $branch->name }}</td>
                              <td class="p-4 border">{{ $branch->street }}</td>
                              <td class="p-4 border">{{ $branch->city }}</td>
                              <td class="p-4 border">{{ $branch->state }}</td>
                              <td class="p-4 border">{{ $branch->zip_code }}</td>
                              <td class="p-4 border">{{ $branch->country }}</td>
                              <td class="p-4 border">{{ $branch->contact }}</td>
                              <td class="p-4 border">
                                  {{ $branch->created_at->format('M d, Y') }}</td>
                              <td class="p-4 border">
                                  {{ $branch->updated_at->format('M d, Y') }}</td>
                              <td class="p-4 border text-center">
                                  <a href="{{ route('admin.branches.edit', $branch) }}"
                                      class="bg-yellow-500 text-white px-4 py-2 rounded-md">Edit</a>
                                  <form action="{{ route('admin.branches.destroy', $branch) }}" method="POST"
                                      style="display:inline;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit"
                                          class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                                  </form>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </x-AdminApp-layout>
