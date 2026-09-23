@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="md:col-span-2 bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-blue-600 p-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-blue-600 text-white text-xs flex items-center justify-center">1</span>
                        Data Pengiriman
                    </h3>

                    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form" class="space-y-4" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="source" value="{{ $source }}">

                        @if ($source === 'direct')
                            <input type="hidden" name="product_id" value="{{ $items->first()->product->id }}">
                            <input type="hidden" name="quantity" value="{{ $items->first()->quantity }}">
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="recipient_name" value="{{ old('recipient_name') }}" class="block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                            <textarea name="shipping_address" rows="3" class="block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('shipping_address') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="pt-2 border-t border-gray-100">
                            <label class="block text-sm font-medium text-gray-700 mb-1 mt-3">Metode Pembayaran</label>
                            <select name="payment_method" id="payment-method" onchange="togglePaymentProof()" class="block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="COD">COD (Bayar di Tempat)</option>
                                <option value="E-Wallet">E-Wallet</option>
                            </select>
                        </div>

                        <div id="payment-proof-section" class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                            <p class="text-sm text-blue-800 font-medium mb-1">
                                <i class="fa-solid fa-circle-info mr-1"></i> Rekening/Akun Tujuan Pembayaran
                            </p>
                            <p class="text-sm text-blue-700 mb-3">
                                Transfer Bank: BCA 1234567890 a.n. Zephyronyx Space<br>
                                E-Wallet: 081234567890 a.n. Zephyronyx Space
                            </p>

                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload Bukti Pembayaran</label>
                            <input type="file" name="payment_proof" accept="image/*" class="block w-full border border-gray-300 rounded-lg px-3 py-2 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Upload screenshot/foto bukti transfer (JPG/PNG, maks 2MB).</p>
                        </div>


                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors mt-2">
                            Lanjut ke Pembayaran
                        </button>
                    </form>
                </div>

                <div class="bg-white rounded-xl shadow-lg border border-gray-200 border-t-4 border-t-green-600 p-6 h-fit">
                    <h3 class="text-sm font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h3>

                    <div class="space-y-3">
                        @foreach ($items as $item)
                            <div class="flex gap-3 pb-3 border-b border-gray-100">
                                @if ($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-12 h-12 rounded-lg object-cover border border-gray-200">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                                        <i class="fa-solid fa-image text-sm"></i>
                                    </div>
                                @endif

                                <div class="flex-1 text-sm">
                                    <p class="font-medium text-gray-800">{{ $item->product->name }}</p>
                                    <p class="text-gray-400 text-xs">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>

                                <p class="font-medium text-gray-800 text-sm">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-200">
                        <p class="font-semibold text-gray-800">Total</p>
                        <p class="text-xl font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function togglePaymentProof() {
            const method = document.getElementById('payment-method').value;
            const section = document.getElementById('payment-proof-section');
            const fileInput = section.querySelector('input[type="file"]');

            if (method === 'COD') {
                section.classList.add('hidden');
                fileInput.required = false;
            } else {
                section.classList.remove('hidden');
                fileInput.required = true;
            }
        }
        document.addEventListener('DOMContentLoaded', togglePaymentProof);
    
        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: `@foreach ($errors->all() as $error){{ $error }}@endforeach`,
                    width: '400px'
                });
            });
        @endif
    </script>
        
@endsection