<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Pesanan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray=100 text-left">
                        <tr>
                            <th class="px-4 py-3 border-b bprder-gray-200 font-semibold text-gray-700">No. Pesanan</th>
                            <th class="px-4 py-3 border-b bprder-gray-200 font-semibold text-gray-700">Pelanggan</th>
                            <th class="px-4 py-3 border-b bprder-gray-200 font-semibold text-gray-700">Tanggal</th>
                            <th class="px-4 py-3 border-b bprder-gray-200 font-semibold text-gray-700">Total</th>
                            <th class="px-4 py-3 border-b bprder-gray-200 font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 border-b bprder-gray-200 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 border-b border-gray-100">#{{ $order->id }}</td>
                                <td class="px-4 py-3 border-b border-gray-100">{{ $order->user->name }}</td>
                                <td class="px-4 py-3 border-b border-gray-100">{{ $order->created_at->format('d M Y, H:i') }}</td>
                                <td class="px-4 py-3 border-b border-gray-100">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 border-b border-gray-100">
                                    <span class="px-2 py-1 rounded text-xs font-medium
                                        @if ($order->status === 'diproses') bg-yellow-100 text-yellow-700
                                        @elseif ($order->status === 'dikirim') bg=blue-100 text-blue-700
                                        @elseif ($order->status === 'selesai') bg-green-100 text-green-700
                                        @else bg-red-100 twxt-red-700
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 border-b border-gray-100">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:underline">Lihat Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada pesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        
        </div>
    </div>
</x-app-layout>