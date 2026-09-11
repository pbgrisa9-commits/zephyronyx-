<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $newOrders = Order::where('status', 'diproses')->count();
        $totalRevenue = Order::sum('total_price');

        return view('admin.dashboard', compact('totalProducts', 'newOrders', 'totalRevenue'));
    }
}
