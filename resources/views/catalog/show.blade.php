<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-uto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6 grid grid-cols-1 md:grid-cols-2 gap-8">

                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-80 object-hover rounded">
                @else
                    <div class="w-full h-80 bg-gray-200 rounded flex items-center justify-center text-gray-400">
                        Tidak ada gambar
                    </div>
                @endif

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>
                    <p class="text-gray-500 mt-1">{{ $product->brand }}</p>

                    <p class="text-blue-600 text-2xl font-bold mt-4">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <div class="mt-4 space y-1 text-sm text-gray-600">
                        <p><span class="font-semibold">Kategori usia:</span> {{ ucfirst($product->age_category) }}</p>
                        <p><span class="font-semibold">Jenis Kelamin:</span> {{ ucfirst($product->gender) }}</p>
                        <p><span class="font-semibold">Cabang Olahraga:</span> {{ ucfirst($product->sport_category) }}</p>
                        @if ($product->size)
                            <p><span class="font-semibold">Ukuran:</span> {{ $product->size }}</p>
                        @endif
                        @if ($product->color)
                            <p><span class="font-semibold">Warna:</span> {{ $product->color }}</p>
                        @endif
                            <p><span class="font-semibold">Stok:</span> {{ $product->stock }}</p>
                        </div>

                        <p class="mt-4 text-gray-700">{{ $product->description }}</p>

                        <div class="mt-6 flex gap-3">
                            <button class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                                Tambah ke Keranjang
                            </button>
                            <button class="bg-green-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                                Beli Sekarang
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>