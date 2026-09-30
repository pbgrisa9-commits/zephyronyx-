<nav x-data="{ open: false }" class="bg-[#0f172a] border-b border-slate-800 shadow-md fixed top-0 left-0 right-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <!-- Logo -->
                <div class="shrink-0 flex items-center gap-2">
                    <a href="{{ route('catalog.index') }}" class="flex items-center gap-2">
                        <img src="{{ asset('images/logo.svg') }}" alt="Zephyronyx Space" class="w-9 h-9 object-contain">
                        <span class="flex flex-col leading-none">
                            <span class="text-white font-bold text-sm tracking-wide">ZEPHYRONYX</span>
                            <span class="text-blue-400 text-[10px] font-semibold tracking-widest">SPACE</span>
                        </span>
                    </a>
                </div>
            </div>

            <!-- Navigation Links (desktop) -->
            <div class="hidden sm:flex sm:items-center sm:gap-6">
                @auth
                    <a href="{{ route('catalog.index') }}" class="text-sm text-slate-300 hover:text-white transition-colors" title="Beranda">
                        <i class="fa-solid fa-house mr-1"></i> Beranda
                    </a>

                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-sm text-amber-400 hover:text-amber-300 transition-colors font-medium" title="Dashboard Admin">
                            <i class="fa-solid fa-gauge mr-1"></i> Dashboard Admin
                        </a>
                    @endif

                    <a href="{{ route('cart.index') }}" class="relative text-slate-300 hover:text-white transition-colors" title="Keranjang">
                        <i class="fa-solid fa-cart-shopping text-lg"></i>
                    </a>

                    <a href="{{ route('orders.index') }}" class="relative text-slate-300 hover:text-white transition-colors" title="Pesanan Saya">
                        <i class="fa-solid fa-receipt text-lg"></i>
                    </a>

                    <!-- Profile Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button type="button" class="flex items-center gap-2 text-slate-300 hover:text-white transition-colors">
                                <span class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-700">
                                    <i class="fa-solid fa-user text-sm"></i>
                                </span>
                                <span class="text-sm">
                                    <span class="block font-medium text-white leading-tight">{{ auth()->user()->name }}</span>
                                    <span class="block text-[11px] text-slate-400 leading-tight">{{ auth()->user()->email }}</span>
                                </span>
                                <i class="fa-solid fa-chevron-down text-[10px]"></i>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                            <button type="button" onclick="confirmLogout()" class="w-full text-left block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 transition-colors">
                                {{ __('Logout') }}
                            </button>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('catalog.index') }}" class="text-sm text-slate-300 hover:text-white transition-colors">
                        <i class="fa-solid fa-house mr-1"></i> Beranda
                    </a>
                    <a href="{{ route('login') }}" class="text-sm text-slate-300 hover:text-white">Login</a>
                    <a href="{{ route('register') }}" class="text-sm bg-blue-600 text-white px-3 py-1.5 rounded-lg hover:bg-blue-700">Register</a>
                @endauth
            </div>

            <!-- Hamburger (mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="text-slate-300 hover:text-white p-2">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-900 border-t border-slate-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('catalog.index')" :active="request()->routeIs('catalog.index')" class="!text-slate-300">
                {{ __('Katalog') }}
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('cart.index')" class="!text-slate-300">
                    {{ __('Keranjang') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('orders.index')" class="!text-slate-300">
                    {{ __('Pesanan Saya') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        @auth
        <div class="pt-4 pb-1 border-t border-slate-800">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ auth()->user()->name }}</div>
                <div class="font-medium text-sm text-slate-400">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="!text-slate-300">
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <button type="button" onclick="confirmLogout()" class="w-full text-left px-4 py-2 text-base font-medium text-slate-300 hover:bg-slate-800 transition-colors">
                    {{ __('Logout') }}
                </button>
            </div>
        </div>
        @endauth
    </div>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
        @csrf
    </form>
</nav>

<script>
    function confirmLogout() {
        Swal.fire({
            icon: 'warning',
            title: 'Yakin ingin logout?',
            text: 'Kamu akan keluar dari akunmu.',
            showCancelButton: true,
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            reserveButtons: true,
            width: '400px'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>