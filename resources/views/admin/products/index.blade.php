<x-layouts.admin :header="'Kelola Data Produk'">

    @if (session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <p class="text-sm text-gray-500">Kelola semua produk yang dijual di toko.</p>
        <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors shadow-sm">
            + Tambah Produk
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-left">
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Produk</th>
                    <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Brand</th>
                    <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Harga</th>
                    <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Stok</th>
                    <th class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-600 text-xs uppercase tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-10 h-10 rounded-lg object-cover border border-gray-200">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 font-semibold text-sm">
                                        {{ strtoupper(substr($product->name, 0, 1)) }}
                                    </div>
                                @endif
                                <span class="font-medium text-gray-900">{{ $product->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $product->brand }}</td>
                        <td class="px-6 py-4 text-gray-900 font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @if ($product->stock <= 5)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                    {{ $product->stock }} (Menipis)
                                </span>
                            @else
                                <span class="text-gray-700">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-3">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>

                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>

</x-layouts.admin>