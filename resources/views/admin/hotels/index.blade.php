<x-AdminApp-layout>
    <div class="container rounded mx-auto px-6 bg-white py-6">
        <div class="flex w-full justify-between items-center mb-6 ">
            <h1 class="text-2xl font-semibold">Hotels</h1>
            <a href="{{ route('admin.hotels.create') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition">Add Hotel</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">{{ session('success') }}</div>
        @endif
        <button id="generate-pdf" data-id="invoice-table" data-type="table"
            class="generate-pdf bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Generate
            PDF</button> <button onclick="exportToExcel()"
            class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">Export
            to Excel</button>

        <div class="overflow-x-auto bg-white   p-5    ">
            <table class="min-w-full table-auto  " id="invoice-table">
                <thead class="bg-blue-100 text-gray-600">
                    <tr class="text-sm font-medium uppercase">
                        <th class="px-6 py-4 text-left s">Name</th>
                        <th class="px-6 py-4 text-left s">Email</th>
                        <th class="px-6 py-4 text-left s">Contact</th>
                        <th class="px-6 py-4 text-left s">City</th>
                        <th class="px-6 py-4 text-left s">State</th>
                        <th class="px-6 py-4 text-left s">Zip Code</th>
                        <th class="px-6 py-4 text-left s">Country</th>
                        <th class="px-6 py-4 text-left s">status</th>

                        <th class="px-6 py-4 text-left s">Created At</th>
                        <th class="px-6 py-4 text-left s">Updated At</th>
                        <th class="px-6 py-4 text-left s">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hotels as $hotel)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 s">{{ $hotel->name }}</td>
                            <td class="px-6 py-4 s">{{ $hotel->email }}</td>
                            <td class="px-6 py-4 s">{{ $hotel->contact }}</td>
                            <td class="px-6 py-4 s">{{ $hotel->city }}</td>
                            <td class="px-6 py-4 s">{{ $hotel->state }}</td>
                            <td class="px-6 py-4 s">{{ $hotel->zip_code }}</td>
                            <td class="px-6 py-4 s">{{ $hotel->country }}</td>
                            <td
                            class="px-4 py-2     font-sans text-xs font-bold {{ $hotel->status == '0' ? 'text-red-500  ' : 'text-green-500  *:' }} uppercase rounded-md select-none whitespace-nowrap ">
                            {{ $hotel->status == '1' ? 'Activated' : 'DeActivated' }}

                        </td>
                            <td class="px-6 py-4 s">{{ $hotel->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 s">{{ $hotel->updated_at->format('d M Y') }}</td>
                            <td class="px-6 py-4   flex justify-around items-center  space-x-4">
                                <a href="{{ route('admin.hotels.edit', $hotel) }}"
                                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Edit</a>

                                <button data-url="{{ route('admin.hotels.show', $hotel->id) }}"
                                    data-title="Hotel Details"
                                    class="bg-transparent show-hotel-details hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                                    View
                                </button>
                                @if ($hotel->status)
                                    <!-- Deactivate Button -->
                                    <form action="{{ route('admin.hotels.destroy', $hotel->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to deactivate this hotel?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">Deactivate</button>
                                    </form>
                                @else
                                    <!-- Activate Button -->
                                    <form action="{{ route('admin.hotels.activate', $hotel->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to activate this hotel?');">
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
    <!-- Hotel Details Modal -->
    <div id="hotel-details-modal"
        class="fixed flex inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <!-- Click-outside container -->
        <div id="hotel-modal-inner"
            class="bg-white w-full max-w-4xl rounded-2xl shadow-2xl p-6 relative overflow-y-auto max-h-[90vh]">
            <!-- Close Button -->
            <button id="close-modal"
                class="absolute top-3 right-4 text-gray-400 hover:text-red-500 text-2xl font-bold">&times;</button>
            <button id="generate-pdf" data-id="hotel-details-content" data-type="table"
                class="generate-pdf bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Generate
                PDF</button>
            <!-- Dynamic Content -->
            <div id="hotel-details-content">
                <!-- Content loaded here -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('hotel-details-modal');
            const modalInner = document.getElementById('hotel-modal-inner');
            const content = document.getElementById('hotel-details-content');

            // Open modal
            document.querySelectorAll('.show-hotel-details').forEach(button => {



                button.addEventListener('click', function() {
                    const url = this.dataset.url;
                    fetch(url)
                        .then(res => res.json())
                        .then(data => {
                            content.innerHTML = data.html;
                            modal.classList.remove('hidden');
                        });
                });
            });

            // Close on X button
            document.getElementById('close-modal').addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            // Close on outside click
            modal.addEventListener('click', (event) => {
                if (!modalInner.contains(event.target)) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>



</x-AdminApp-layout>
