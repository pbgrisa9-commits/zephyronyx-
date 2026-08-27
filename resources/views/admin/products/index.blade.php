<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Data produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('admin.products.create')}}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                    + Tambah produk
                </a>
            </div>

            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-left">
                        <tr>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Brand</th>
                            <th class="px-4 py-3">Harga</th>
                            <th class="px-4 py-3">Stok</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse ($products as $product)
                            <tr>
                                <td class="px-4 py-3">{{ $product->name }}</td>
                                <td class="px-4 py-3">{{ $product->brand }}</td>
                                <td class="px-4 py-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">{{ $product->stock}}</td>
                                <td class="px-4 py-3 space-x-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>

        </div>
    </div>
</x-app-layout>