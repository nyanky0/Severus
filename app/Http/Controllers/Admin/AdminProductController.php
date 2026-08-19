<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_en' => 'required|string|max:255',
            'name_id' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_id' => 'required|string',
            'price_idr' => 'required|numeric|min:0',
            'tokopedia_url' => 'nullable|url',
            'shopee_url' => 'nullable|url',
            'image' => 'nullable|image|max:4096',
            'image_url_input' => 'nullable|string',
            'tip_size' => 'nullable|string',
            'joint_type' => 'nullable|string',
            'weight_oz' => 'nullable|string',
            'deflection_grade' => 'nullable|string',
            'chalk_friction' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['name_en']) . '-' . time();
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image_path'] = $path;
        } elseif ($request->filled('image_url_input')) {
            $data['image_path'] = $request->image_url_input;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_en' => 'required|string|max:255',
            'name_id' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_id' => 'required|string',
            'price_idr' => 'required|numeric|min:0',
            'tokopedia_url' => 'nullable|url',
            'shopee_url' => 'nullable|url',
            'image' => 'nullable|image|max:4096',
            'image_url_input' => 'nullable|string',
            'tip_size' => 'nullable|string',
            'joint_type' => 'nullable|string',
            'weight_oz' => 'nullable|string',
            'deflection_grade' => 'nullable|string',
            'chalk_friction' => 'nullable|string',
            'stock' => 'required|integer|min:0',
        ]);

        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image_path'] = $path;
        } elseif ($request->filled('image_url_input')) {
            $data['image_path'] = $request->image_url_input;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
