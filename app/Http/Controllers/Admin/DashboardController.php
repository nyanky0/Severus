<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $products = Product::with('category')->latest()->take(10)->get();

        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'products'));
    }
}
