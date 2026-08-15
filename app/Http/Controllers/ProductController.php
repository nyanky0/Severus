<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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
