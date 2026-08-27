<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Katalog Produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="GET" action="{{ route('catalog.index') }}" class="bg-white rounded-lg shadow p-4 mb-6 grid grid-cols-1 sm:grid-cols-5 gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." class="border rounded px-3 py-2 text-sm col-span-2">

                <select name="brand" class="border rounded px-3 py-2 text-sm">
                    <option value="">Semua Brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                    @endforeach
                </select>

                <select name="age_category" class="border rounded px-3 py-2 text-sm">
                    <option value="">Semua Usia</option>
                    <option value="dewasa" {{ request('age_category') == 'dewasa' ? 'selected' : '' }}>Dewasa</option>
                    <option value="remaja" {{ request('age_category') == 'remaja' ? 'selected' : '' }}>Remaja</option>
                    <option value="anak" {{ request('age_category') == 'anak' ? 'selected' : '' }}>Anak</option>
                </select>

                <select name="gender" class="border rounded px-3 py-2 text-sm">
                    <option value="">Semua Gender</option>
                    <option value="pria" {{ request('gender') == 'pria' ? 'selected' : '' }}>Pria</option>
                    <option value="wanita" {{ request('gender') == 'wanita' ? 'selected' : '' }}>Wanita</option>
                </select>

                <buttton type="submit" class="bg-blue-600 text-white rounded px-3 py-2 text-sm hover:bg-blue-700 col-span-full sm:col-span-1">
                    Cari
                </buttton>
            </form>

            @if ($products->isEmpty())
                <p class="text-gray-500">Belum ada produk tersedia.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg-grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <div class="bg-white rounded-lg shadow p-4">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-fill h-40 object-cover rounded mb-3">
                            @else
                                <div class="w-full h-40 bg-gray-200 rounded mb-3 flex items-center justify-center text-gray-400">
                                    Tidak ada gambar
                                </div>
                            @endif

                            <h3 class="font-semibold text-gray-800">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $product->brand }}</p>
                            <p class="text-blue-600 font-bold mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                            <a href="{{ route('catalog.show', $product->id) }}" class="mt-3 inline-block text-sm text-blue-500 hover:underline">
                                Lihat Detail
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>