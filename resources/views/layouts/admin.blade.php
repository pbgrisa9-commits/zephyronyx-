<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Zephyronyx Space') . ' - Admin')</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100">

    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col fixed inset-y-0 left-0 h-screen z-40">
        <div class="h-[73px] px-6 border-b border-slate-800 flex items-center gap-2">
            <img src="{{ asset('images/logo.svg') }}" alt="Zephyronyx Space" class="w-8 h-8">
            <div>
                <h1 class="text-white font-bold text-base leading-tight">ZEPHYRONYX</h1>
                <p class="text-xs text-slate-400">SPACE Admin</p>
            </div>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800' }}">
                <i class="fa-solid fa-gauge w-4 text-center"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded text-sm {{ request()->routeIs('admin.products.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800' }}">
                <i class="fa-solid fa-box w-4 text-center"></i>
                Kelola Data Produk
            </a>

            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded text-sm {{ request()->routeIs('admin.orders.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800' }}">
                <i class="fa-solid fa-bag-shopping w-4 text-center"></i>
                Kelola Data Pesanan
            </a>

            <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-3 py-2 rounded text-sm {{ request()->routeIs('admin.reports.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800' }}">
                <i class="fa-solid fa-chart-line w-4 text-center"></i>
                Laporan Penjualan
            </a>

            <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded text-sm {{ request()->routeIs('admin.profile.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800' }}">
                <i class="fa-solid fa-user w-4 text-center"></i>
                Profil Saya
            </a>

            <a href="{{ route('catalog.index') }}" target="_blank" class="flex items-center gap-3 px-3 py-2 rounded text-sm hover:bg-slate-800 text-amber-300">
                <i class="fa-solid fa-arrow-up-right-from-square w-4 text-center"></i>
                Lihat Katalog
            </a>
        </nav>
    </aside>

    <header class="h-[73px] bg-[#0f172a] border-b border-slate-800 px-6 flex justify-between items-center fixed top-0 left-64 right-0 z-30">
        <h2 class="font-semibold text-lg text-white">@yield('header', 'Dashboard')</h2>

        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
            @csrf
        </form>

        <div class="flex items-center gap-5">

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button type="button" class="flex items-center gap-2 text-slate-300 hover:text-white transition-colors">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-700">
                            <i class="fa-solid fa-user text-sm"></i>
                        </span>
                        <span class="text-sm">
                            <span class="block font-medium text-white leading-tight">{{ Auth::user()->name }}</span>
                            <span class="block text-[11px] text-slate-400 leading-tight">Admin</span>
                        </span>
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('admin.profile.edit')">
                        {{ __('Profil Saya') }}
                    </x-dropdown-link>
                    <button type="button" onclick="confirmLogout()" class="w-full text-left block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 transition-colors">
                        {{ __('Logout') }}
                    </button>
                </x-slot>
            </x-dropdown>
        </div>
    </header>

    <main class="ml-64 pt-[97px] px-6 pb-6 min-h-screen">
        @yield('content')
    </main>

    <script>
        function confirmLogout() {
            Swal.fire({
                icon: 'warning',
                title: 'Yakin ingin logout?',
                text: 'Kamu akan keluar dari akun Admin ZEPHYRONYX SPACE.',
                showCancelButton: true,
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                width: '400px'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>

    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true,
                width: '400px'
            });
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#2563eb',
                width: '400px'
            });
        });
    </script>
    @endif

    @if (session('warning'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: '{{ session('warning') }}',
                confirmButtonColor: '#f59e0b',
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
                title: 'Validasi Gagal',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#2563eb',
                width: '400px'
            });
        });
    </script>
    @endif

    @yield('scripts')
</body>
</html>