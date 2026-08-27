<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-gray-500 text-sm">Total Produk</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalProducts }}</p>
                </div>
            </div>
        
            <div class="flex gap-4">
                <a href="{{ route('admin.products.index') }}" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                    Kelola Produk
                </a>
            </div>
            
        </div>
    </div>
</x-app-layout>