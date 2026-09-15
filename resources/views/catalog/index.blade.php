<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Katalog Produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('error'))
                <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded-lg text-sm">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 p-5 mb-6">
                <form method="GET" action="{{ route('catalog.index') }}" class="grid grid-cols-1 sm:grid-cols-5 gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 col-span-2">

                    <select name="brand" class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                        @endforeach
                    </select>

                    <select name="age_category" class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Usia</option>
                        <option value="dewasa" {{ request('age_category') == 'dewasa' ? 'selected' : '' }}>Dewasa</option>
                        <option value="remaja" {{ request('age_category') == 'remaja' ? 'selected' : '' }}>Remaja</option>
                        <option value="anak" {{ request('age_category') == 'anak' ? 'selected' : '' }}>Anak</option>
                    </select>

                    <select name="gender" class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Gender</option>
                        <option value="pria" {{ request('gender') == 'pria' ? 'selected' : '' }}>Pria</option>
                        <option value="wanita" {{ request('gender') == 'wanita' ? 'selected' : '' }}>Wanita</option>
                    </select>

                    <button type="submit" class="bg-blue-600 text-white rounded px-4 py-2 text-sm font-medium hover:bg-blue-700 transition-colors col-span-full sm:col-span-1">
                        <i class="fa-solid fa-magnifying-glass mr-1"></i> Cari
                    </button>
                </form>
            </div>

            @if ($products->isEmpty())
                <p class="bg-white rounded-xl shadow-lg border border-gray-200 p-10 text-center text-gray-500">
                    Belum ada produk tersedia.
                </p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-200">
                            <div class="relative">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                                        <i class="fa-solid fa-image text-3xl"></i>
                                    </div>
                                @endif

                                @if ($product->stock <= 5)
                                    <span class="absolute top-2 right-2 bg-red-100 text-red-700 text-xs font-semibold px-2 py-1 rounded-full">
                                        Stok Terbatas
                                    </span>
                                @endif
                            </div>

                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 truncate">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $product->brand }}</p>
                                <p class="text-blue-600 font-bold mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                                <a href="{{ route('catalog.show', $product->id) }}" class="mt-3 block text-center bg-blue-50 text-blue-700 text-sm font-medium py-2 rounded-lg hover:bg-blue-100 transition-colors">
                                    Lihat Detail
                                </a>
                            </div>
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