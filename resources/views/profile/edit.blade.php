<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profil Saya 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if (session('status') === 'profile-updated')
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded-lg text-sm">
                    Profil berhasil diperbarui.
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 overflow-hidden">
                <div class="bg-blue-50 px-6 py-5 bprder-b border-blue-100 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-xl">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div> 
                        <p class="font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <div class="p-6">
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded-lg text-sm">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                        @csrf
                        @method('patch')

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm text-medium hover:bg-blue-700 transition-colors">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-amber-500 p-6 mt-6">
                <h3 class="text-sm font-semibold text-gray-900 mb-4">Ubah Password</h3>

                <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                    @csrf
                    @method('put')

                    <div>
                        <label clas="block text-sm font-medium text-gray-700 mb-1">Passwrod Saat Ini</label>
                        <input type="password" name="current_password" class="block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 fous:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('current_password', 'updatePassword')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password Baru</label>
                        <input type="password" name="password" class="block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        Ubah Password
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>