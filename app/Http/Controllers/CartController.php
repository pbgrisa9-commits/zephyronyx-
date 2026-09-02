<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
            'size' => ['nullable', 'string'],
            'color' => ['nullable', 'string'],
        ]);

        if ($validated['quantity'] > $product->stock) {
            return back()->withErrors([
                'quantity' => 'Stok tidak mencukupi. Stok tersedia: ' . $product->stock,
            ]);
        }

        $existingItem = CartItem::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->where('size', $validated['size'] ?? null)
            ->where('color', $validated['color'] ?? null)
            ->first();

        if ($existingItem) {
            $newQuantity = $existingItem->quantity + $validated['quantity'];

            if ($newQuantity > $product->stock) {
                return back()->withErrors([
                    'quantity' => 'Total jumlah di keranjang melebihi stok yang tersedia.',
                ]);
            }

            $existingItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
                'size' => $validated['size'],
                'color' => $validated['color'] ?? null,
                'price' => $product->price,
            ]);
        }

        return redirect()->route('catalog.show', $product->id)->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }
}
