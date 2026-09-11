<x-layouts.admin :header="'Edit Produk'">

    <div class="max-w-3xl mx-auto">

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 overflow-hidden">
            <div class="bg-blue-50 px-6 py-3 border-b border-blue-100">
                <p class="text-sm font-medium text-blue-800">Form Edit Produk</p>
            </div>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="p-6 space-y-4" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kategori Usia</label>
                        <select name="age_category" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="dewasa" {{ old('age_category', $product->age_category) == 'dewasa' ? 'selected' : '' }}>Dewasa</option>
                            <option value="remaja" {{ old('age_category', $product->age_category) == 'remaja' ? 'selected' : '' }}>Remaja</option>
                            <option value="anak" {{ old('age_category', $product->age_category) == 'anak' ? 'selected' : '' }}>Anak</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="gender" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="pria" {{ old('gender', $product->gender) == 'pria' ? 'selected' : '' }}>Pria</option>
                            <option value="wanita" {{ old('gender', $product->gender) == 'wanita' ? 'selected' : '' }}>Wanita</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Cabang Olahraga</label>
                    <input type="text" name="sport_category" value="{{ old('sport_category', $product->sport_category) }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="misal: sepak bola, bola basket, fitness">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Harga</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ukuran (opsional)</label>
                        <input type="text" name="size" value="{{ old('size', $product->size) }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Warna (opsional)</label>
                        <input type="text" name="color" value="{{ old('color', $product->color) }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi (opsional)</label>
                    <textarea name="description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Gambar Produk (opsional)</label>

                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-lg mb-2 border border-gray-200">
                    @endif

                    <input type="file" name="image" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 font-medium">
                        Update Produk
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="bg-white text-gray-700 border border-gray-300 px-5 py-2 rounded-lg hover:bg-gray-50 font-medium">
                        Batal
                    </a>
                </div>
            </form>
        </div>

    </div>

</x-layouts.admin>