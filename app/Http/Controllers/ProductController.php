<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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

        $products = $query->latest()->get();
        $siteContents = \App\Models\SiteContent::all()->pluck('value', 'key_name');

        return view('products.index', compact('categories', 'products', 'siteContents'));
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('products.show', compact('product'));
    }

    public function jsonDetail(Product $product)
    {
        $product->load('category');
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'formatted_price_idr' => $product->formatted_price_idr,
            'price_idr' => $product->price_idr,
            'tokopedia_url' => $product->tokopedia_url ?: 'https://www.tokopedia.com/severus',
            'image_url' => $product->image_url,
            'tip_size' => $product->tip_size ?: '-',
            'joint_type' => $product->joint_type ?: '-',
            'weight_oz' => $product->weight_oz ?: '-',
            'deflection_grade' => $product->deflection_grade ?: '-',
            'chalk_friction' => $product->chalk_friction ?: '-',
            'category_name' => $product->category->name,
            'stock' => $product->stock,
        ]);
    }
}
