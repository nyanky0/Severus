<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SiteContent;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount(['products' => function($q) {
            $q->where('is_active', true);
        }])->orderBy('sort_order')->get();

        $query = Product::with('category')->where('is_active', true);

        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->take(6)
            ->get();

        $products = $query->latest()->get();

        $siteContents = SiteContent::all()->pluck('value', 'key_name');

        return view('landing', compact('categories', 'products', 'featuredProducts', 'siteContents'));
    }
}
