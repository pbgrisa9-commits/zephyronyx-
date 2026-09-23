@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Profil Saya
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 overflow-hidden">
                <div class="bg-blue-50 px-6 py-5 border-b border-blue-100 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-xl">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <div class="p-6 space-y-8">

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

                        <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                            Simpan Perubahan
                        </button>
                    </form>

                    <hr class="border-gray-100">

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 mb-4">Ubah Password</h3>

                        <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                            @csrf
                            @method('put')

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                                <input type="password" name="current_password" class="block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('current_password', 'updatePassword')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                <input type="password" name="password" class="block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                Ubah Password
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    @if (session('status') === 'profile-updated')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon:'success',
                    title: 'Berhasil!',
                    text: 'Profil berhasil diperbarui.',
                    timer:3000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    width: '400px'
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Menyimpan',
                    text: `@foreach ($errors->all() as $error){{ $error }} @endforeach`,
                    confirmButtonText: 'Coba Lagi',
                    width: '400px'
                });
            });
        </script>
    @endif
@endsection