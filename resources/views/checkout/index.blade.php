<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl txt-gray-800 leading-tight">
            Checkout
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Data Penerima</h3>

                    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                        @csrf

                        <input type="hidden" name="source" value="{{ $source }}">

                        @if ($source === 'direct')
                            <input type="hidden" name="product_id" value="{{ $items->first()->product->id }}">
                            <input type="hidden" name="quantity" value="{{ $items->first()->quantity }}">
                        @endif

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Nama Penerima</label>
                            <input type="text" name="recipient_name" value="{{ old('recipient_name') }}" class="mt-1 block w-full border rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                            <textarea name="shipping_address" rows="3" class="mt-1 block w-full border rounded px-3 py-2">{{ old('shipping_address') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="mt-1 block w-full border rounded px-3 py-2">
                        </div>
                        
                        <div class="mb-4">
                            <lable class="block text-sm font-medium text-gray-700">Metode Pembayaran</lable>
                            <select name="payment_method" class="mt-1 block w-full border rounded px-3 py-2">
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="COD">COD (Bayar di Tempat)</option>
                                <option value="E-Wallet">E-Wallet</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-green-600 text-white py-3 rounded hover:bg-green-700 font-medium">
                            Buat Pesanan
                        </button>
                    </form>
                </div>

                <div class="bg-white rounded-lg shadow p-6 h-fit">
                    <h3 class="font-semibold text-gray-800 mb-4">Ringkasan Pesanan</h3>

                    <div class="space-y-3">
                        @foreach ($items as $item)
                            <div class="flex-justify-between text-sm border-b pb-3">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $item->product->name }}</p>
                                    <p class="text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                                <p class="font-medium text-gray-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-between items-center mt-4 pt-4 border-t">
                        <p class="font-semibold text-gray-800">Total</p>
                        <p class="text-xl font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>