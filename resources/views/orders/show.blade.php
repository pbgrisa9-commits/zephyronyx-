@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Detail Pesanan #{{ $order->id }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a href="{{ route('orders.index') }}" class="text-sm text-blue-600 hover:underline">
                    <i class="fa-solid fa-arrow-left mr-1"></i>Kembali ke Riwayat Pesanan
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Status Pesanan</p>
                        <span class="inline-block mt-1 px-3 py-1 rounded-full text-sm font-semibold
                            @if ($order->status === 'diproses') bg-amber-100 text-amber-700
                            @elseif ($order->status === 'dikirim') bg-blue-100 text-blue-700
                            @elseif ($order->status === 'selesai') bg-green-100 text-green-700
                            @else bg-red-100 text-red-700
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Tanggal Pesanan</p>
                        <p class="font-medium text-gray-800 mt-1">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 mb-6">
                <h3 class="text-sm font-semibold text-gray-900 mb-4">Data Pengiriman</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-400 text-xs">Nama Penerima</p>
                        <p class="font-medium text-gray-800">{{ $order->recipient_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Nomor Telepon</p>
                        <p class="font-medium text-gray-800">{{ $order->phone }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-gray-400 text-xs">Alamat Pengiriman</p>
                        <p class="font-medium text-gray-800">{{ $order->shipping_address }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Metode Pembayaran</p>
                        <p class="font-medium text-gray-800">{{ $order->payment_method }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-green-600 overflow-hidden">
                <div class="divide-y divide-gray-100">
                    @foreach ($order->items as $item)
                        <div class="p-5 flex items-center gap-4">
                            @if ($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-14 h-14 rounded-lg object-cover border border-gray-200">
                            @else
                                <div class="w-14 h-14 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @endif

                            <div class="flex-1">
                                <p class="font-medium text-gray-900">{{ $item->product->name }}</p>
                                <p class="text-xs text-gray-400">{{ $item->size ?? '-' }} / {{ $item->color ?? '-' }} &middot; {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                        
                            <p class="font-medium text-gray-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                    <p class="font-semibold text-gray-900">Total Pembayaran</p>
                    <p class="text-xl font-bold text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                </div>
            </div>

        </div>
    </div>
@endsection