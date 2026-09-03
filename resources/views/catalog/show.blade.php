<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded text-sm">
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

            <div class="bg-white rounded-lg shadow p-6 grid grid-cols-1 md:grid-cols-2 gap-8">

                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-80 object-cover rounded">
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

                    <div class="mt-4 space-y-1 text-sm text-gray-600">
                        <p><span class="font-semibold">Kategori Usia:</span> {{ ucfirst($product->age_category) }}</p>
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

                    @auth
                        <form id="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-6">
                            @csrf

                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="flex items-center gap-3 mb-4">
                                <label class="text-sm font-medium text-gray-700">Jumlah:</label>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="border rounded px-3 py-1 w-20">
                            </div>

                            @if ($product->size)
                                <input type="hidden" name="size" value="{{ $product->size }}">
                            @endif

                            @if ($product->color)
                                <input type="hidden" name="color" value="{{ $product->color }}">
                            @endif

                            <div class="flex gap-3">
                                <button type="submit" form="add-to-cart-form" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                                    Tambah ke Keranjang
                                </button>

                                <button type="submit" formaction="{{ route('checkout.create') }}" formmethod="GET" class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700">
                                    Beli Sekarang
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="mt-6">
                            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 inline-block">
                                Login untuk Membeli
                            </a>
                        </div>
                    @endauth
                </div>

            </div>
        </div>
    </div>
</x-app-layout>