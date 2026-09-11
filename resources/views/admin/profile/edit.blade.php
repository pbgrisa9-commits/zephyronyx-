<x-layouts.admin :header="'Profile Saya'">

    <div class="max-w-2xl mx-auto">

        @if (session('success'))
            <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded text:sm">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 overflow-hidden">
            <div class="bg-blue-50 px-6 py-5 border-b border-blue-100 flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-xl">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-semibold text-gray-900">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                </div>
            </div>
            
            <form action="{{ route('admin.profile.update') }}" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border rounded-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border rounded-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="pt-2 border-t border-gray-100">
                    <p class="text-xs text-gray-500 mb-3 mt-3">Ubah Password (opsional)</p>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Password Baru</label>
                            <input type="password" name="password" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Biarkan kosong jika tidak ingin mengubah">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Konfimasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="bg-blue-600 text-white px-6  py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>

</x-layouts.admin>