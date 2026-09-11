<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Zephyronyz space') }} - Admin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100">
    <div class="flex min-h-screen">

        <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col">
            <div class="px-6 py-5 border-b border-slate-700">
                <h1 class="text-white font-bold text-lg">ZEPHYRONYX</h1>
                <p class="text-xs text-slate-400">SPACE Admin</p>
            </div>

            <nav class="flex-1 px-3 py-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800' }}">
                    <i class="fa-solid fa-gauge w-4 text-center"></i>
                    dashboard
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
            </nav>

            <div class="px-3 py-4 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Yakin ingin logout dari akun ini?');">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded text-sm text-red-400 hover:bg-slate-800">
                        <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

    
        <div class="flex-1 flex flex-col">
            <header class="bg-white border-b px-6 py-4 flex justify-between items-center">
                <h2 class="font-semibold text-lg text-gray-800">{{ $header ?? 'Dashboard' }}</h2>
                <span class="text-sm text-gray-500">{{ Auth::user()->name }}</span>
            </header>

            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>

    </div>
</body>
</html>