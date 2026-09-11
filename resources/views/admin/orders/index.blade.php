<x-layouts.admin :header="'Kelola Data Pesanan'">

    @if (session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <p class="text-sm text-gray-500 mb-4">Kelola dan pantau status semua pesanan pelanggan.</p>

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-left">
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">No. Pesanan</th>
                    <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Pelanggan</th>
                    <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Tanggal</th>
                    <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Total</th>
                    <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Status</th>
                    <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($orders as $order)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 bfont-medium text-gray-900">#{{ $order->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold text-xs">
                                    {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                </div>
                                <span class="text-gray-700">{{ $order->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                @if ($order->status === 'diproses') bg-amber-100 text-amber-700
                                @elseif ($order->status === 'dikirim') bg-blue-100 text-blue-700
                                @elseif ($order->status === 'selesai') bg-green-100 text-green-700
                                @else bg-red-100 twxt-red-700
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Lihat Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
    
</x-layouts.admin>