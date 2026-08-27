<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lh:px-8">
            <div class="bg-white rounded-lg shadow py-6">

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red=700 px-4 py-2 eounded text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="mt-1 block w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Brand</label>
                        <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" class="mt-1 block w-full border rounded px-3 py-2">
                    </div>

                    <div class="grid grod-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kategori Usia</label>
                            <select name="age_category" class="mt-1 block w-full border rounded px-3 py-2">
                                <option value="dewasa" {{ old('age_category', $product->age_category) == 'dewasa' ? 'selected' : '' }}>Dewasa</option>
                                <option value="remaja" {{ old('age_category', $product->age_category) == 'remaja' ? 'selected' : '' }}>Remaja</option>
                                <option value="anak" {{ old('age_category', $product->age_category) == 'anak' ? 'selected' : '' }}>Anak</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="gender" class="mt-1 block w-full border rounded px-3 py-2">
                                <option value="pria" {{ old('gender', $product->gender) == 'pria' ? 'selected' : '' }}>Pria</option>
                                <option value="wanita" {{ old('gender', $product->gender) == 'wanita' ? 'selected' : '' }}>Wanita</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Cabang Olahraga</label>
                        <input type="text" name="sport_category" value="{{ old('sport_category', $product->sport_category) }}" class="mt-1 block w-full border rounded px-3 py-2" placeholder="misal: sepak bola, bola basket, fitness">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Harga</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="mt-1 block w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stok</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="mt-1 block w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ukuran (opsional)</label>
                            <input type="text" name="size" value="{{ old('size', $product->size) }}" class="mt-1 block w-full border rounded px-3 py-2">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Warna (opsional)</label>
                            <input type="text" name="color" value="{{ old('color', $product->color) }}" class="mt-1 block w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi (opsional)</label>
                        <textarea name="description" rows="3" class="mt-1 block w-full border rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                            Update Produk
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="bg-gray-200 text-gray-700 px-5 py-2 rounded hover:bg-gray-300">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>