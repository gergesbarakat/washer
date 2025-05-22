<div class="space-y-6 h-full p-5 ">
    <div>
        <h2 class="text-2xl font-bold">{{ $hotel->name }}</h2>
        <p class="text-gray-600">{{ $hotel->email }} | {{ $hotel->contact }}</p>
        <p class="text-sm text-gray-500">{{ $hotel->city }}, {{ $hotel->state }}, {{ $hotel->zip_code }},
            {{ $hotel->country }}</p>
    </div>

    <div class="flex flex-col overflow-auto h-full">
        <h3 class="text-xl font-semibold mb-4">الطرود</h3>

        @forelse ($parcels as $parcel)
            <div class="border rounded-lg p-4 mb-4 bg-gray-50" style="border: 1px black; margin-top: 20px;">
                <div class="mb-2">
                    <p><strong>رقم الطرد:</strong> #{{ $parcel->id }}</p>
                    <p><strong>الحالة:</strong> {{ ucfirst($parcel->status) }}</p>
                    <p><strong>تاريخ الإنشاء:</strong> {{ $parcel->created_at->format('d M Y') }}</p>
                </div>

                <div>
                    <h4 class="font-semibold mb-2">العناصر:</h4>
                    @if ($parcel->parcelItems->count())
                        <table class="min-w-full text-sm text-gray-800 border">
                            <thead class="bg-gray-100 font-semibold text-gray-700">
                                <tr>
                                    <th class="p-2 border">#</th>
                                    <th class="p-2 border text-left">المنتج</th>
                                    <th class="p-2 border text-right">الكمية</th>
                                    <th class="p-2 border text-right">السعر</th>
                                    <th class="p-2 border text-right">المجموع الجزئي</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach ($parcel->parcelItems as $index => $item)
                                    @php
                                        $price = $item->product->price ?? 0;
                                        $subtotal = $item->quantity * $price;
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td class="p-2 border text-center">{{ $index + 1 }}</td>
                                        <td class="p-2 border">{{ $item->product->name ?? 'N/A' }}</td>
                                        <td class="p-2 border text-right">{{ $item->quantity }}</td>
                                        <td class="p-2 border text-right">{{ number_format($price, 2) }}</td>
                                        <td class="p-2 border text-right">{{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="font-bold bg-gray-50">
                                <tr>
                                    <td colspan="4" class="p-2 border text-right">الإجمالي</td>
                                    <td class="p-2 border text-right">{{ number_format($total, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    @else
                        <p class="text-gray-500 italic">لا توجد عناصر.</p>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-gray-500 italic">لا توجد طرود لهذا الفندق.</p>
        @endforelse
    </div>
</div>
