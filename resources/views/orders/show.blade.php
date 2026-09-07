<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pesanan #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Status Pesanan</p>
                        <span class="inline-block mt-1 px-2 oy-1 rounded text-xs font-medium
                            @if ($order->status === 'diproses') bg-yellow-100 text-yellow-700
                            @elseif ($order->status === 'dikirim') bg-blue-100 text-blue-700
                            @elseif ($ordrer->status === 'selesai') bg-green-100 text-green-700
                            @else bg-red-100 text-red-700
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div>
                        <p class="text-gray-500">Tanggal Pesanan</p>
                        <p class="font-medium text-gray-800">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Nama Penerima</p>
                        <p class="font-medium text-gray-800">{{ $order->recipient_name }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Nomor Telepon</p>
                        <p class="font-medium text-gray-800">{{ $order->phone }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Alamat Pengiriman</p>
                        <p class="font-medium text-gray-800">{{ $order->shipping_address }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Metode Pembayaran</p>
                        <p class="font-medium text-gray-800">{{ $order->payment_method }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Produk</th>
                            <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Ukuran/Warna</th>
                            <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Harga</th>
                            <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Jumlah</th>
                            <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="px-4 py-3 border-b border-gray-100">{{ $item->product->name }}</td>
                                <td class="px-4 py-3 border-b border-gray-100">{{ $item->size ?? '-' }} / {{ $item->color ?? '-' }}</td>
                                <td class="px-4 py-3 border-b border-gray-100">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 border-b border-gray-100">{{ $item->quantity }}</td>
                                <td class="px-4 py-3 border-b border-gray-100">Rp {{ number_format($item->price * $item->quantity,0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 bg-white rounded-lg shadow p-6 flex justify-between items-center">
                <p class="font-semibold text-gray-800">Total Pembayaran</p>
                <p class="text-xl font-bold text-blue-600">Rp {{ number_format($order->total_price,0, ',', '.') }}</p>
            </div>

            <div class="mt-4">
                <a href="{{ route('orders.index') }}" class="text-blue-600 hover:underline text-sm">Kembali ke Riwayat Pesanan</a>
            </div>

        </div>
    </div>
</x-app-layout>