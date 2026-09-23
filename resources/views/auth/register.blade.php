<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - {{ config('app.name', 'Zephyronyx Space') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col sm:flex-row">

        <div class="w-full sm:w-2/5 bg-slate-900 text-white p-8 flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16">
                <img src="{{ asset('images/logo.svg') }}" alt="Zephyronyx Space" class="w-full h-full">
            </div>
            <h1 class="text-xl font-bold tracking-wide">ZEPHYRONYX</h1>
            <p class="text-sm text-slate-400 tracking-widest mb-6">SPACE</p>

            <h2 class="text-lg font-semibold">Buat Akun Baru</h2>
            <p class="text-sm text-slate-400 mt-1">Daftar untuk mulai berbelanja</p>
        </div>

        <div class="w-full sm:w-3/5 p-8 sm:p-10">

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus class="block w-full border border-gray-300 rounded-lg px-3 py-2.5 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="block w-full border border-gray-300 rounded-lg px-3 py-2.5 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required class="block w-full border border-gray-300 rounded-lg px-3 py-2.5 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <button type="button" onclick="togglePassword('password', 'password-icon')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fa-solid fa-eye" id="password-icon"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" required class="block w-full border border-gray-300 rounded-lg px-3 py-2.5 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <button type="button" onclick="togglePassword('password_confirmation', 'password-confirmation-icon')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fa-solid fa-eye" id="password-confirmation-icon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors mt-2">
                    DAFTAR
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-1">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">Masuk di sini</a>
            </p>

        </div>

    </div>

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
                    title: 'Pendaftaran Gagal',
                    text: `@foreach ($errors->all() as $error){{ $error }} @endforeach`,
                    confirmButtonText: 'Coba Lagi',
                    width: '400px',
                    padding: '1.5rem'
                });
            });
        </script>
    @endif

</body>
</html>