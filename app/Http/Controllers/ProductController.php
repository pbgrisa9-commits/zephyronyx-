<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        if ($request->filled('age_category')) {
            $query->where('age_category', $request->age_category);
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('sport_category')) {
            $query->where('sport_category', $request->sport_category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(12)->withQueryString();
        $brands = Product::distinct()->pluck('brand');

        return view('catalog.index', compact('products', 'brands'));
    }

    public function show(Product $product)
    {
        return view('catalog.show', compact('product'));
    }
}
