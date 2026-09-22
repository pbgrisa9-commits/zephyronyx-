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
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('brand', 'like', '%' . $search . '%')
                  ->orWhere('sport_category', 'like', '%' . $search . '%');
            });
        }


        $products = $query->latest()->paginate(12)->withQueryString();
        $brands = Product::distinct()->pluck('brand');
        $sportCategories = Product::distinct()->pluck('sport_category')->filter();

        return view('catalog.index', compact('products', 'brands', 'sportCategories'));
    }

    public function show(Product $product)
    {
        return view('catalog.show', compact('product'));
    }
}
