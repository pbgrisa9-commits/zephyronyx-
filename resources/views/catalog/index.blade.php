<x-app-layout>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div id="catalog-app">

                @if (session('error'))
                    <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded-lg text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @php
                    // Tentukan tab mana yang sedang aktif
                    $activeTab = 'semua';
                    if (request()->filled('sport_category')) $activeTab = 'cabor';
                    if (request()->filled('brand')) $activeTab = 'brand';

                    $baseNoSportBrand = request()->except(['sport_category', 'brand', 'search', 'page']);
                    $baseNoBrandSport = request()->except(['brand', 'sport_category', 'search', 'page']);
                @endphp

                <!-- Tab bar + Search -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 p-5 mb-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                        <!-- Tabs -->
                        <div class="flex items-center gap-6" id="tab-bar">
                            <a href="{{ route('catalog.index', request()->except(['sport_category','brand','page'])) }}"
                               class="filter-link tab-item pb-1 text-sm font-semibold {{ $activeTab == 'semua' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                                Semua Produk
                            </a>
                            <button type="button" data-tab="cabor"
                               class="tab-toggle pb-1 text-sm font-semibold {{ $activeTab == 'cabor' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                                Cabang Olahraga
                            </button>
                            <button type="button" data-tab="brand"
                               class="tab-toggle pb-1 text-sm font-semibold {{ $activeTab == 'brand' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                                Brand
                            </button>
                        </div>

                        <!-- Search -->
                        @if ($activeTab == 'semua')
                            <form method="GET" action="{{ route('catalog.index') }}" class="ajax-form flex gap-2 w-full sm:w-auto">
                                <input type="text" name="search" 
                                    placeholder="Cari nama produk, brand, atau kategori..."
                                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-72">
                                <button type="submit" class="bg-blue-600 text-white rounded-lg px-5 py-2 text-sm font-medium hover:bg-blue-700 transition-colors whitespace-nowrap">
                                    <i class="fa-solid fa-magnifying-glass mr-1"></i> Cari
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- Panel: Cabang Olahraga -->
                    <div id="panel-cabor" class="mt-4 flex flex-wrap gap-2 {{ $activeTab == 'cabor' ? '' : 'hidden' }}">
                        <a href="{{ route('catalog.index', array_merge($baseNoSportBrand, ['sport_category' => ''])) }}"
                           class="filter-link px-3 py-1.5 rounded-full text-xs font-medium border {{ request('sport_category', '') == '' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-300 hover:bg-gray-50' }}">
                            Semua Cabang
                        </a>
                        @foreach ($sportCategories as $sport)
                            <a href="{{ route('catalog.index', array_merge($baseNoSportBrand, ['sport_category' => $sport])) }}"
                               class="filter-link px-3 py-1.5 rounded-full text-xs font-medium border {{ request('sport_category') == $sport ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-300 hover:bg-gray-50' }}">
                                {{ $sport }}
                            </a>
                        @endforeach
                    </div>

                    <!-- Panel: Brand -->
                    <div id="panel-brand" class="mt-4 flex flex-wrap gap-2 {{ $activeTab == 'brand' ? '' : 'hidden' }}">
                        <a href="{{ route('catalog.index', array_merge($baseNoBrandSport, ['brand' => ''])) }}"
                           class="filter-link px-3 py-1.5 rounded-full text-xs font-medium border {{ request('brand', '') == '' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-300 hover:bg-gray-50' }}">
                            Semua Brand
                        </a>
                        @foreach ($brands as $brand)
                            <a href="{{ route('catalog.index', array_merge($baseNoBrandSport, ['brand' => $brand])) }}"
                               class="filter-link px-3 py-1.5 rounded-full text-xs font-medium border {{ request('brand') == $brand ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-300 hover:bg-gray-50' }}">
                                {{ $brand }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Grid Produk (full width, 4 kolom) -->
                @if ($products->isEmpty())
                    <p class="bg-white rounded-xl shadow-lg border border-gray-200 p-10 text-center text-gray-500">
                        Belum ada produk tersedia.
                    </p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($products as $product)
                            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-200">
                                <div class="relative">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                                            <i class="fa-solid fa-image text-3xl"></i>
                                        </div>
                                    @endif

                                    @if ($product->stock <= 5)
                                        <span class="absolute top-2 right-2 bg-red-100 text-red-700 text-xs font-semibold px-2 py-1 rounded-full">
                                            Stok Terbatas
                                        </span>
                                    @endif
                                </div>

                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 truncate">{{ $product->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $product->brand }}</p>
                                    <p class="text-blue-600 font-bold mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                                    <a href="{{ route('catalog.show', $product->id) }}" class="mt-3 block text-center bg-blue-50 text-blue-700 text-sm font-medium py-2 rounded-lg hover:bg-blue-100 transition-colors">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8" id="pagination-wrapper">
                        {{ $products->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>

    <script>
    (function () {
        const container = document.getElementById('catalog-app');

        function bindTabToggles() {
            container.querySelectorAll('.tab-toggle').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const target = this.dataset.tab;
                    const caborPanel = container.querySelector('#panel-cabor');
                    const brandPanel = container.querySelector('#panel-brand');

                    if (target === 'cabor') {
                        caborPanel.classList.toggle('hidden');
                        brandPanel.classList.add('hidden');
                    } else if (target === 'brand') {
                        brandPanel.classList.toggle('hidden');
                        caborPanel.classList.add('hidden');
                    }

                    // Update highlight tab (visual only, tidak filter apa-apa sampai user pilih chip)
                    container.querySelectorAll('.tab-toggle, .tab-item').forEach(function (el) {
                        el.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                        el.classList.add('text-gray-500');
                    });
                    this.classList.remove('text-gray-500');
                    this.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                });
            });
        }

        function bindEvents() {
            container.querySelectorAll('a.filter-link, #pagination-wrapper a').forEach(function (link) {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    loadCatalog(this.href);
                });
            });

            container.querySelectorAll('form.ajax-form').forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const params = new URLSearchParams(new FormData(form)).toString();
                    loadCatalog(form.action + '?' + params);
                });
            });

            bindTabToggles();
        }

        function loadCatalog(url, pushState = true) {
            container.style.opacity = '0.5';
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function (res) { return res.text(); })
                .then(function (html) {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.getElementById('catalog-app');
                    if (newContent) {
                        container.innerHTML = newContent.innerHTML;
                        container.style.opacity = '1';
                        bindEvents();
                        if (pushState) {
                            history.pushState({}, '', url);
                        }
                    }
                })
                .catch(function () {
                    container.style.opacity = '1';
                });
        }

        window.addEventListener('popstate', function () {
            loadCatalog(location.href, false);
        });

        bindEvents();
    })();
    </script>
</x-app-layout>