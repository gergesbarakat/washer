<x-CourierApp-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1">
                        <div class="text-2xl font-semibold">{{ count($parcels->where('status', 'delivered')) }}</div>
                    </div>
                    <div class="text-sm font-medium text-gray-400">المكتملة</div>
                </div>
                {{-- <div class="dropdown">
                    <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i
                            class="ri-more-fill"></i></button>
                    <ul
                        class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                        <li>
                            <a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">الملف
                                الشخصي</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">الإعدادات</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">تسجيل
                                الخروج</a>
                        </li>
                    </ul>
                </div> --}}
            </div>

        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="text-2xl font-semibold mb-1">{{ count($parcels->where('status', 'pending')) }}
                    </div>
                    <div class="text-sm font-medium text-gray-400">قيد الانتظار</div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1">{{ count($parcels->where('status', 'canceled')) }}</div>
                    <div class="text-sm font-medium text-gray-400">الملغاة</div>
                </div>

            </div>
        </div>
    </div>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">إحصائيات الطلبات</div>

            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                <div class="rounded-md border border-dashed border-gray-200 p-4">
                    <div class="flex items-center mb-0.5">
                        <div class="text-xl font-semibold">
                            {{ count($parcels->whereIn('status', ['pending', 'in_transit'])) }}</div>
                        <span
                            class="p-1 rounded text-[12px] font-semibold bg-blue-500/10 text-blue-500 leading-none ml-1">$80</span>
                    </div>
                    <span class="text-gray-400 text-sm">نشط</span>
                </div>
                <div class="rounded-md border border-dashed border-gray-200 p-4">
                    <div class="flex items-center mb-0.5">
                        <div class="text-xl font-semibold">{{ count($parcels->where('status', 'delivered')) }}</div>
                        <span
                            class="p-1 rounded text-[12px] font-semibold bg-emerald-500/10 text-emerald-500 leading-none ml-1">+$469</span>
                    </div>
                    <span class="text-gray-400 text-sm">مكتمل</span>
                </div>
                <div class="rounded-md border border-dashed border-gray-200 p-4">
                    <div class="flex items-center mb-0.5">
                        <div class="text-xl font-semibold">{{ count($parcels->where('status', 'canceled')) }}</div>
                        <span
                            class="p-1 rounded text-[12px] font-semibold bg-rose-500/10 text-rose-500 leading-none ml-1">-$130</span>
                    </div>
                    <span class="text-gray-400 text-sm">ملغي</span>
                </div>
            </div>
            <div>
                <canvas id="order-chart"></canvas>
            </div>
        </div>
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">الأرباح</div>

            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[460px]">
                    <thead>
                        <tr>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">
                                الخدمة</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                الأرباح</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">
                                الحالة</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($parcels as $parcel)
                            <tr>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <div class="flex items-center">
                                        <img src="https://placehold.co/32x32" alt=""
                                            class="w-8 h-8 rounded object-cover block">
                                        <span class="text-gray-600 text-sm font-medium ml-2 truncate">
                                            #{{ $parcel->id }}
                                        </span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-gray-700">
                                        {{ $parcel->courier->name ?? '—' }}
                                    </span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-yellow-400/10 text-yellow-500',
                                            'delivered' => 'bg-green-500/10 text-green-500',
                                            'canceled' => 'bg-rose-500/10 text-rose-500',
                                        ];
                                    @endphp
                                    <span
                                        class="inline-block p-1 rounded font-medium text-[12px] leading-none {{ $statusClasses[$parcel->status] ?? 'bg-gray-100 text-gray-500' }}">
                                        {{ $parcel->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // start: Chart
        @if (Route::current()->getName() == 'dashboard')

            var parcels = @php  echo json_encode($parcels); @endphp

            function generateNDays(n) {
                const data = []
                for (let i = 0; i < n; i++) {
                    const date = new Date()
                    date.setDate(date.getDate() - n + i + 1)
                    data.push(date.toLocaleString('en-US', {
                        month: 'short',
                        day: 'numeric'
                    }))
                }
                return data
            }

            const labels = generateNDays(7)

            function getStatusCountsByDay(parcels, labels) {
                const statusCounts = {
                    pending: Array(labels.length).fill(0),
                    delivered: Array(labels.length).fill(0),
                    canceled: Array(labels.length).fill(0)
                }

                parcels.forEach(parcel => {
                    const createdAt = new Date(parcel.created_at)
                    const formattedDate = createdAt.toLocaleString('en-US', {
                        month: 'short',
                        day: 'numeric'
                    })

                    const labelIndex = labels.indexOf(formattedDate)
                    if (labelIndex !== -1) {
                        if (parcel.status === 'pending') statusCounts.pending[labelIndex]++
                        if (parcel.status === 'delivered') statusCounts.delivered[labelIndex]++
                        if (parcel.status === 'canceled') statusCounts.canceled[labelIndex]++
                    }
                })

                return statusCounts
            }

            const statusCounts = getStatusCountsByDay(parcels, labels)
            new Chart(document.getElementById('order-chart'), {
                type: 'line',
                data: {
                    labels: generateNDays(7),
                    datasets: [{
                            label: 'نشط', // Active (i.e., pending/in_transit)
                            data: statusCounts.pending,
                            backgroundColor: 'rgba(59, 130, 246, 0.5)', // blue
                            borderColor: 'rgba(59, 130, 246, 1)',
                            fill: true,
                            pointBackgroundColor: 'rgb(59, 130, 246)',
                            borderColor: 'rgb(59, 130, 246)',
                            backgroundColor: 'rgb(59 130 246 / .05)',
                            tension: .2
                        },
                        {
                            label: 'مكتمل', // Completed (delivered)
                            data: statusCounts.delivered,
                            backgroundColor: 'rgba(16, 185, 129, 0.5)', // green
                            borderColor: 'rgba(16, 185, 129, 1)',
                            fill: true,
                            pointBackgroundColor: 'rgb(16, 185, 129)',
                            borderColor: 'rgb(16, 185, 129)',
                            backgroundColor: 'rgb(16 185 129 / .05)',
                            tension: .2
                        },
                        {
                            label: 'ملغي', // Canceled
                            data: statusCounts.canceled,
                            backgroundColor: 'rgba(244, 63, 94, 0.5)', // red
                            borderColor: 'rgba(244, 63, 94, 1)',
                            fill: true,
                            pointBackgroundColor: 'rgb(244, 63, 94)',
                            borderColor: 'rgb(244, 63, 94)',
                            backgroundColor: 'rgb(244 63 94 / .05)',
                            tension: .2
                        },
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        @endif



        // end: Chart
    </script>
</x-CourierApp-layout>
