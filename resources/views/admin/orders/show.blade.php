<x-layouts.admin :header="'Detail Pesanan #' . $order->id">

    @if (session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-4xl mx-auto">

        <!-- Info Pesanan -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 p-6 mb-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-wide mb-1">Pelanggan</p>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold text-xs">
                            {{ strtoupper(substr($order->user->name, 0, 1)) }}
                        </div>
                        <p class="font-medium text-gray-900">{{ $order->user->name }} <span class="text-gray-400 font-normal">({{ $order->user->email }})</span></p>
                    </div>
                </div>

                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-wide mb-1">Tanggal Pesanan</p>
                    <p class="font-medium text-gray-900">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>

                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-wide mb-1">Nama Penerima</p>
                    <p class="font-medium text-gray-900">{{ $order->recipient_name }}</p>
                </div>

                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-wide mb-1">Nomor Telepon</p>
                    <p class="font-medium text-gray-900">{{ $order->phone }}</p>
                </div>

                <div class="sm:col-span-2">
                    <p class="text-gray-500 text-xs uppercase tracking-wide mb-1">Alamat Pengiriman</p>
                    <p class="font-medium text-gray-900">{{ $order->shipping_address }}</p>
                </div>

                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-wide mb-1">Metode Pembayaran</p>
                    <p class="font-medium text-gray-900">{{ $order->payment_method }}</p>
                </div>
            </div>
        </div>

        <!-- Ubah Status -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-amber-500 p-6 mb-6">
            <h3 class="text-sm font-semibold text-gray-900 mb-3">Ubah Status Pesanan</h3>

            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex gap-3 items-center">
                @csrf
                @method('PATCH')

                <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="diproses" {{ $order->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="dikirim" {{ $order->status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ $order->status === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>

                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                    Simpan Status
                </button>
            </form>
        </div>

        <!-- Daftar Produk -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-green-600 overflow-hidden mb-6">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-left">
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Produk</th>
                        <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Ukuran/Warna</th>
                        <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Harga</th>
                        <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Jumlah</th>
                        <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($order->items as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $item->product->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $item->size ?? '-' }} / {{ $item->color ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-600">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                <p class="font-semibold text-gray-900">Total Pembayaran</p>
                <p class="text-xl font-bold text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
            </div>
        </div>

        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:underline text-sm font-medium">← Kembali ke Kelola Pesanan</a>

    </div>

</x-layouts.admin>