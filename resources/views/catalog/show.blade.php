@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 grid grid-cols-1 md:grid-cols-2 gap-8">

                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-lg">
                @else
                    <div class="w-full h-96 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                        <i class="fa-solid fa-image text-4xl"></i>
                    </div>
                @endif

                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                    <p class="text-gray-500 mt-1">{{ $product->brand }}</p>

                    <p class="text-blue-600 text-3xl font-bold mt-4">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <div class="grid grid-cols-2 gap-3 mt-5 text-sm">
                        <div class="bg-gray-50 rounded-lg px-3 py-2">
                            <p class="text-gray-400 text-xs">Cabang Olahraga</p>
                            <p class="font-medium text-gray-800">{{ $product->sport_category }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg px-3 py-2">
                            <p class="text-gray-400 text-xs">Kategori Usia</p>
                            <p class="font-medium text-gray-800">{{ ucfirst($product->age_category) }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg px-3 py-2">
                            <p class="text-gray-400 text-xs">Jenis Kelamin</p>
                            <p class="font-medium text-gray-800">{{ ucfirst($product->gender) }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg px-3 py-2">
                            <p class="text-gray-400 text-xs">Stok</p>
                            <p class="font-medium text-gray-800">{{ $product->stock }} tersedia</p>
                        </div>
                        @if ($product->size)
                            <div class="bg-gray-50 rounded-lg px-3 py-2">
                                <p class="text-gray-400 text-xs">Ukuran</p>
                                <p class="font-medium text-gray-800">{{ $product->size }}</p>
                            </div>
                        @endif
                        @if ($product->color)
                            <div class="bg-gray-50 rounded-lg px-3 py-2">
                                <p class="text-gray-400 text-xs">Warna</p>
                                <p class="font-medium text-gray-800">{{ $product->color }}</p>
                            </div>
                        @endif
                    </div>

                    @if ($product->description)
                        <p class="mt-4 text-gray-600 text-sm">{{ $product->description }}</p>
                    @endif

                    @auth
                        <form id="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-6 pt-6 border-t border-gray-100">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="flex items-center gap-3 mb-4">
                                <label class="text-sm font-medium text-gray-700">Jumlah:</label>
                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                    <button type="button" onclick="decreaseQty()" class="px-3 py-1.5 bg-gray-50 hover:bg-gray-100 text-gray-600">−</button>
                                    <input type="number" id="qty-input" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-14 text-center border-0 focus:outline-none focus:ring-0 no-spinner">
                                    <button type="button" onclick="increaseQty()" class="px-3 py-1.5 bg-gray-50 hover:bg-gray-100 text-gray-600">+</button>
                                </div>
                            </div>

                            @if ($product->size)
                                <input type="hidden" name="size" value="{{ $product->size }}">
                            @endif
                            @if ($product->color)
                                <input type="hidden" name="color" value="{{ $product->color }}">
                            @endif

                            <div class="flex gap-3">
                                <button type="submit" class="flex-1 bg-blue-50 text-blue-700 border border-blue-200 px-5 py-2.5 rounded-lg font-medium hover:bg-blue-100 transition-colors">
                                    <i class="fa-solid fa-cart-plus mr-2"></i>Tambah Keranjang
                                </button>
                                <button type="submit" formaction="{{ route('checkout.create') }}" formmethod="GET" class="flex-1 bg-blue-600 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                    Beli Sekarang
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <a href="{{ route('login') }}" class="block text-center bg-blue-600 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                Login untuk Membeli
                            </a>
                        </div>
                    @endauth
                </div>

            </div>
        </div>
    </div>

    <style>
        .no-spinner::-webkit-outer-spin-button,
        .no-spinner::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .no-spinner[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection

@section('scripts')
    <script>
        function increaseQty() {
            const input = document.getElementById('qty-input');
            const max = parseInt(input.max);
            if (parseInt(input.value) < max) input.value = parseInt(input.value) + 1;
        }
        function decreaseQty() {
            const input = document.getElementById('qty-input');
            if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
        }

        @if ($errors->any())
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: `@foreach ($errors->all() as $error){{ $error }} @endforeach`,
                        confirmButtonText: 'Coba Lagi',
                        width: '400px'
                    });
                });
        @endif
    </script>

@endsection