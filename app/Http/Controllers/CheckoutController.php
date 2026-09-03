<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function create(Request $request)
    {
        if ($request->has('product_id')) {
            $product = Product::findOrFail($request->product_id);

            $items = collect([
                (object) [
                    'product' => $product,
                    'quantity' => $request->quantity ?? 1,
                    'size' => $product->size,
                    'color' => $product->color,
                    'price' => $product->price,
                ]
            ]);

            $source = 'direct';
        } else {
            $cartItems = CartItem::with('product')
                ->where('user_id', auth()->id())
                ->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Keranjang kamu kosong.');
            }

            $items = $cartItems;
            $source = 'cart';
        }

        $total = $items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('checkout.index', compact('items', 'total', 'source'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_name' => ['required', 'string', 'max:255'],
            'shipping_address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'],
            'payment_method' => ['required', 'string'],
            'source' => ['required', 'in:cart,direct'],
            'product_id' => ['nullable', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        if ($validated['source'] === 'direct') {
            $product = Product::findOrFail($validated['product_id']);
            $quantity = $validated['quantity'] ?? 1;

            if ($quantity > $product->stock) {
                return back()->withErrors(['quantity' => 'Stok tidak mencukupi.']);
            }

            $items = collect([
                (object) [
                    'product' => $product,
                    'quantity' => $quantity,
                    'size'=> $product->size,
                    'color' => $product->color,
                    'price' => $product->price,
                ],
            ]);
        } else {
            $items = CartItem::with('product')->where('user_id', auth()->id())->get();

            if ($items->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Keranjang kamu kosong.');
            }

            foreach ($items as $item) {
                if ($item->quantity > $item->product->stock) {
                    return redirect()->route('cart.index')->withErrors([
                        'quantity' => 'Stok produk "'. $item->product->name . '" tidak mencukupi.',
                    ]);
                }
            }
            
        }

        $total = $items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        DB::transaction(function () use ($validated, $items, $total) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'recipient_name' => $validated['recipient_name'],
                'shipping_address' => $validated['shipping_address'],
                'phone' => $validated['phone'],
                'payment_method' => $validated['payment_method'],
                'status' => 'diproses',
                'total_price' => $total,
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'size' => $item->size,
                    'color' => $item->color,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            if ($validated['source'] === 'cart') {
                CartItem::where('user_id', auth()->id())->delete();
            }
        });

        return redirect()->route('catalog.index')->with('success', 'Pesanan berhasil dibuat! Terima kasih telah berbelanja.');
    }
}