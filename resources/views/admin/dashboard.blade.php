@extends('layouts.admin')

@section('title', 'Dashboard Admin - Zephyronyx Space')
@section('header', 'Dashboard Admin')

@section('content')

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
                    <i class="fa-solid fa-sack-dollar text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

    </div>

    
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 mb-8">
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

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-900">Pesanan Terbaru</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-xs text-blue-600 hover:underline font-medium">Lihat Semua →</a>
        </div>

        @if ($recentOrders->isEmpty())
            <p class="px-6 py-10 text-center text-gray-500 text-sm">Belum ada pesanan.</p>
        @else
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
                    @foreach ($recentOrders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900">#{{ $order->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold text-xs">
                                        {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                    </div>
                                    <span class="text-gray-700">{{ $order->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
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
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Lihat Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    
@endsection