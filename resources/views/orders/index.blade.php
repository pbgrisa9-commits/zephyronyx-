<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Pesanan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if ($orders->isEmpty())
                <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                    Kamu belum pernah membuat Pesanan.
                    <a href="{{ route('catalog.index') }}" class="text-blue-600 hover:underline">Mulai belanja</a>
                </div>
            @else
                <div class="bg-white rounded-lg shadow overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-100 text-left">
                            <tr>
                                <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">No. Pesanan</th>
                                <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Tanggal</th>
                                <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Total</th>
                                <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Status</th>
                                <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 border-b border-gray-100">#{{ $order->id }}</td>
                                    <td class="px-4 py-3 border-b border-gray-100">{{ $order->created_at->format('d M Y, H:i') }}</td>
                                    <td class="px-4 py-3 border-b border-gray-100">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-b border-gray-100">
                                        <span class="px-2 py-1 rounded text-xs font-medium
                                            @if ($order->status === 'diproses') bg-yellow-100 text-yellow-700
                                            @elseif ($order->status === 'dikirim') bg-blue-100 text-blue-700
                                            @elseif ($order->status === 'selesai') bg-green-100 text-green-700
                                            @else bg-red-100 text-red-700
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 border-b border-gray-100">
                                        <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 hover:underline">Lihat Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>