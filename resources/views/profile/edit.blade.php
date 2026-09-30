@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profil Saya</h2>
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

                    <form action="{{ route('profile.update') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="pt-4 border-t border-gray-100">
                            <p class="text-xs text-gray-500 mb-3 mt-3">
                                <i class="fa-solid fa-lock mr-1"></i>
                                Ubah Password (opsional - kosongkan jika tidak ingin mengubah)
                            </p>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
                                    <div class="relative">
                                        <input type="password" name="current_password" id="current_password" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan password lama">
                                        <button type="button" onclick="togglePassword('current_password', 'current_password-icon')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                            <i class="fa-solid fa-eye" id="current_password-icon"></i>
                                        </button>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Password Baru</label>
                                    <div class="relative">
                                        <input type="password" name="password" id="password" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Minimal 8 karakter">
                                        <button type="button" onclick="togglePassword('password', 'password-icon')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                            <i class="fa-solid fa-eye" id="password-icon"></i>
                                        </button>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                                    <div class="relative">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Ketik ulang password baru">
                                        <button type="button" onclick="togglePassword('password_confirmation', 'password_confirmation-icon')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                            <i class="fa-solid fa-eye" id="password_confirmation-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors shadow-sm">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                text: `@foreach ($errors->all() as $error){{ $error }} @endforeach`,
                confirmButtonColor: '#2563eb',
                confirmButtonText: 'Coba Lagi',
                width: '400px'
            });
        });
        </script>
    @endif

    @if (session('status') == 'profile-updated')
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title:'Berhasil',
                text: 'Profil berhasil diperbarui.',
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true,
                width: '400px'
            });
        });
        </script>
    @endif
@endsection