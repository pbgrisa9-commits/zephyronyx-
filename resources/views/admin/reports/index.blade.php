<x-layouts.admin :header="'Laporan Penjualan'">
    
    <div class="max-w-5xl mx-auto">

        <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 p-6 mb-6">
            <h3 clas="text-sm font-semibold text-gray-900 mb-4">Filter Periode</h3>
    
            <form method="GET" action="{{ route('admin.reports.index') }}" class="flex flex-wrap gap-3 items-end">
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-40">
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-40">
                </div>

                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                    Tampilkan Laporan
                </button>

                <a href="{{ route('admin.reports.index') }}" class="text-sm text-gray-500 hover:text-gray-700 px-2">Reset</a>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-lg border border-gray-200 border-t-4 border-t-amber-500 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Jumlah Pesanan</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalOrders }}</p>
                    </div>

                    <div class="w-12 h-12 flex items-center justify-center rounded-full bg-amber-100">
                        <i class="fa-solid fa-bag-shopping text-amber-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-green-600 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Penjualan</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100">
                        <i class="fa-solid fa-sack-dollar text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        @if ($orders->isEmpty())
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-10 text-center text-gray-500">
                Belum ada data penjualan pada periode ini.
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 overflow-hidden">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-left">
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">No. Pesanan</th>
                            <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Tanggal</th>
                            <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Status</th>
                            <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors"> 
                                <td class="px-6 py-4 font-medium text-gray-900">#{{ $order->id }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        @if ($order->status === 'diproses') bg-amber-100 text-amber-700
                                        @elseif ($order->status === 'dikirim') bg-blue-100 text-blue-700
                                        @elseif ($order->status === 'selesai') bg-green-100 text-green-700
                                        @else bg-red-100 text-red-700
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>

</x-layouts.admin>