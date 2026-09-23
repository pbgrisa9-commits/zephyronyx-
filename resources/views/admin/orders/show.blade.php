@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->id . ' - Admin')
@section('header', 'Detail Pesanan #' . $order->id)

@section('content')
    <div class="max-w-4xl mx-auto">

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
                @if ($order->payment_proof)
                    <div class="sm:col-span-2">
                        <p class="text-gray-500 text-xs uppercase tracking-wide mb-1">Bukti Pembayaran</p>
                        <button type="button" onclick="openImageModal('{{ asset('storage/' . $order->payment_proof) }}')">
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran" class="w-40 h-40 object-cover rounded-lg border border-gray-200 hover:opacity-80 transition-opacity">
                        </button>
                    </div>
                @endif
            </div>
        </div>

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

        <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-amber-500 p-6 mb-6">
            <h3 class="text-sm font-semibold text-gray-900 mb-3">Ubah Status Pesanan</h3>

            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex gap-3 items-center" id="form-update-status">
                @csrf
                @method('PATCH')

                <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="diproses" {{ $order->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="dikirim" {{ $order->status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ $order->status === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>

                <button type="button" onclick="confirmUpdateStatus()" class="bg-blue-600 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                    Simpan Status
                </button>
            </form>
        </div>


        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:underline text-sm font-medium">← Kembali ke Kelola Pesanan</a>

    </div>

    <div id="image-modal" class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4" onclick="closeImageModal(event)">
        <div class="relative max-w-2xl w-full">
            <button type="button" onclick="closeImageModal()" class="absolute -top-10 right-0 text-white hover:text-gray-300 text-2xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <img id="image-modal-img" src="" alt="Bukti Pembayaran" class="w-full max-h-[80vh] object-contain rounded-lg shadow-2xl">
        </div>
    </div>

    <script>
        function openImageModal(src) {
            document.getElementById('image-modal-img').src = src;
            document.getElementById('image-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal(event) {
            if (!event || event.target.id === 'image-modal' || event.target.closest('button')) {
                document.getElementById('image-modal').classList.add('hidden');
                document.body.style.overflow = '';
            }
        }
        
        function confirmUpdateStatus() {
            Swal.fire({
                icon: 'question',
                title: 'Simpan perubahan status?',
                text: 'Status pesanan ini akan diperbarui.',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                width: '400px'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-update-status').submit();
                }
            });
        }

    </script>
@endsection