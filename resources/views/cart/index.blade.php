<x-app-layout>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded-lg text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if ($cartItems->isEmpty())
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-10 text-center">
                    <i class="fa-solid fa-cart-shopping text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 mb-1">Keranjang kamu masih kosong.</p>
                    <p class="text-gray-400 text-sm mb-5">Yuk, mulai belanja perlengkapan olahraga favoritmu!</p>
                    <a href="{{ route('catalog.index') }}" class="inline-block bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
                        Lihat Katalog Produk
                    </a>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 overflow-hidden mb-6">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 text-left">
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Produk</th>
                                <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Harga</th>
                                <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Jumlah</th>
                                <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Subtotal</th>
                                <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($cartItems as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @if ($item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-12 h-12 rounded-lg object-cover border border-gray-200">
                                            @else
                                                <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                                                    <i class="fa-solid fa-image"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $item->product->name }}</p>
                                                <p class="text-xs text-gray-400">{{ $item->size ?? '-' }} / {{ $item->color ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center border border-gray-300 rounded-lg overflow-hidden w-fit">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" name="quantity" value="{{ max(1, $item->quantity - 1) }}" class="px-2.5 py-1 bg-gray-50 hover:bg-gray-100 text-gray-600">−</button>
                                            <span class="px-3 text-sm font-medium">{{ $item->quantity }}</span>
                                            <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}" @if($item->quantity >= $item->product->stock) disabled @endif class="px-2.5 py-1 bg-gray-50 hover:bg-gray-100 text-gray-600 disabled:opacity-40">+</button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini dari keranjang?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-green-600 p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Total Belanja ({{ $cartItems->count() }} item)</p>
                        <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</p>
                    </div>

                    <div class="flex gap-3 w-full sm:w-auto">
                        <a href="{{ route('catalog.index') }}" class="flex-1 sm:flex-none text-center bg-white text-gray-700 border border-gray-300 px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                            Kembali
                        </a>
                        <a href="{{ route('checkout.create') }}" class="flex-1 sm:flex-none text-center bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                            Checkout
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>