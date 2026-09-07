<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Penjualan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <form method="GET" action="{{ route('admin.reports.index') }}" class="bg-white rounded-lg shadow p-4 mb-6 flex flex-wrap gap-3 items-end">
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" class="border rounded px-3 py-2 text-sm w-40">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Sampai Tanggal</label>
                    <label type="date" name="end_date" value="{{ $endDate }}" class="border rounded px-3 py-2 text-sm w-40">
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                    Tampilkan Laporan
                </button>

                <a href="{{ route('admin.reports.index') }}" class="text-sm text-gray-500 hover:underline">Reset</a>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-5">
                    <p class="text-gray-500 text-sm">Jumlah Pesanan</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalOrders }}</p>
                </div>

                <div class="bg-whhite rounded-lg shadow p-6">
                    <P class="text-gray-500 text-sm">Total Penjualan</P>
                    <p class="text-3xl font-bold text-green-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
            </div>

            @if ($orders->isEmpty())
                <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                    Belum ada data penjualan pada periode ini.
                </div>
            @else
                <div class="bg-white rounded-lg shadow overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-100 text-left">
                            <tr>
                                <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">No. Pesanan</th>
                                <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Tanggal</th>
                                <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Status</th>
                                <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr> 
                                    <td class="px-4 py-3 border-b border-gray-100">#{{ $order->id }}</td>
                                    <td class="px-4 py-3 border-b border-gray-100">{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="px-4 py-3 border-b border-gray-100">{{ ucfirst($order->status) }}</td>
                                    <td class="px-4 py-3 border-b border-gray-100">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>