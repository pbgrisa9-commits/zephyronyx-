<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pesanan #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 bg-reg-100 text-red-700 px-4 py-2 rounded text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Pelanggan</p>
                        <p class="font-medium text-gray-800">{{ $order->user->name }} ({{ $order->user->email }})</p>
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

            <div class="bg-white rounded-lg shadow py-6 mb-6">
                <h3 class="font-semibold text-gray-800 mb-3">Ubah Status Pesanan</h3>

                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex gap-3 items-center">
                    @csrf
                    @method('PATCH')

                    <select name="status" class="border rounded px-3 py-2 text-sm">
                        <option value="diproses" {{ $order->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="dikirim" {{ $order->status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                        <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ $order->status === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                        Simpan Status
                    </button>
                </form>
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
                                <td class="px-4 py-3 border-b border-gray-100">{{ $item->size ?? '-' }} / {{$item->color ?? '-' }}</td>
                                <td class="px-4 py-3 border-b border-gray-100">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 border-b border-gray-100">{{ $item->quantity }}</td>
                                <td class="px-4 py-3 border-b border-gray-100">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 bg-white rounded-lg shadow p-6 flex justify-between items-center">
                <p class="font-semibold text-gray-800">Total Pembayaran</p>
                <p class="text-xl font-bold text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:underline text-sm">Kembali ke Kelola Pesanan</a>
            </div>

        </div>
    </div>
</x-app-layout>