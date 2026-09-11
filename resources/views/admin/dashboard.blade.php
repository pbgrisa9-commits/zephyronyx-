<x-layouts.admin :header="'Dashboard Admin'">

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">

        <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Produk</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalProducts }}</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100">
                    <i class="fa-solid fa-box text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-amber-500 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pesanan Baru</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $newOrders }}</p>
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
                    <i class="fa-solid fa-sack-dollar text-green-600 tex-xl"></i>
                </div>
            </div>
        </div>

    </div>

    
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
        <h3 class="text-sm font-semibold text-gray-900 mb-4">Menu Cepat</h3>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <a href="{{ route('admin.products.index') }}" class="flex flex-col items-center justify-center gap-2 p-4 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-colors text-center">
                <i class="fa-solid fa-box text-blue-600 text-xl"></i>
                <span class="text-xs font-medium text-gray-700">Kelola Produk</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="flex flex-col items-center justify-center gap-2 p-4 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-colors text-center">
                <i class="fa-solid fa-bag-shopping text-blue-600 text-xl"></i>
                <span class="text-xs font-medium text-gray-700">Kelola Pesanan</span>
            </a>

            <a href="{{ route('admin.reports.index') }}" class="flex flex-col items-center justify-center gap-2 p-4 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-colors text-center">
                <i class="fa-solid fa-chart-line text-blue-600 text-xl"></i>
                <span class="text-xs font-medium text-gray-700">Laporan Penjualan</span>
            </a>

            <a href="{{ route('admin.profile.edit') }}" class="flex flex-col items-center justify-center gap-2 p-4 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-colors text-center">
                <i class="fa-solid fa-user text-blue-600 text-xl"></i>
                <span class="text-xs font-medium text-gray-700">Profil Saya</span>
            </a>
        </div>
    </div>

</x-layouts.admin>