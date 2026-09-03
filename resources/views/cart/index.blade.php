<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Keranjang Belanja
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 pu=y-2 rounded text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if ($cartItems->isEmpty())
                <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                    Keranjang kamu masih kosong.
                    <a href="{{ route('catalog.index') }}" class="text-blue-600 hover:underline">Lihat katalog produk</a>
                </div>
            @else
                <div class="bg-white rounded-lg shadow overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-100 text-left">
                            <tr>
                                <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Produk</th>
                                <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Ukuran/warna</th>
                                <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Harga</th>
                                <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Jumlah</th>
                                <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Subtotal</th>
                                <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 border-b border-gray-100">{{ $item->product->name }}</td>
                                    <td class="px-4 py-3 border-b border-gray-100">
                                        {{ $item->size ?? '-' }} / {{ $item->color ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 border-b border-gray-100">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-b border-gray-100">{{ $item->quantity }}</td>
                                    <td class="px-4 py-3 border-b border-gray-100">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-b border-gray-100">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="inline-flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="border rounded px-2 py-1 w-16 text-sm">
                                            <button type="submit" class="text-blue-600 hover:underline text-sm">Update</button>
                                        </form>

                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus produk ini dari keranjang?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm ml-2">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 bg-white rounded-lg shadow p-6 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total Belanja</p>
                        <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</p>
                    </div>

                    <a href="{{ route('checkout.create') }}" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700 inline-block">
                        Checkout
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
