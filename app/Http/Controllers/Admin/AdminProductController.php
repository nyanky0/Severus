<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Apply Search
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name_en', 'like', $searchTerm)
                  ->orWhere('name_id', 'like', $searchTerm)
                  ->orWhere('description_en', 'like', $searchTerm);
            });
        }

        // Apply Category Filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Apply Sorting
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price_idr', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price_idr', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name_en', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name_en', 'desc');
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        // Apply Dynamic Pagination
        $perPage = $request->per_page;
        if ($perPage === 'all') {
            $perPage = $query->count() > 0 ? $query->count() : 1;
        } elseif (!in_array($perPage, [20, 50, 100])) {
            $perPage = 20; // Default
        }

        $products = $query->paginate($perPage);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
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
            'tokopedia_url' => 'nullable|string',
            'shopee_url' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'image_url_input' => 'nullable|string',
            'tip_size' => 'nullable|string',
            'joint_type' => 'nullable|string',
            'weight_oz' => 'nullable|string',
            'tip' => 'nullable|string',
            'ferrule' => 'nullable|string',
            'is_featured' => 'nullable',
            'is_active' => 'nullable',
            'options' => 'nullable|array',
        ]);

        if (!empty($data['tokopedia_url']) && !str_starts_with($data['tokopedia_url'], 'http://') && !str_starts_with($data['tokopedia_url'], 'https://')) {
            $data['tokopedia_url'] = 'https://' . $data['tokopedia_url'];
        }
        if (!empty($data['shopee_url']) && !str_starts_with($data['shopee_url'], 'http://') && !str_starts_with($data['shopee_url'], 'https://')) {
            $data['shopee_url'] = 'https://' . $data['shopee_url'];
        }

        $data['slug'] = Str::slug($data['name_en']) . '-' . time();
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image_path'] = $path;
        } elseif ($request->filled('image_url_input')) {
            $data['image_path'] = $request->image_url_input;
        }

        $product = Product::create($data);

        if ($request->filled('options')) {
            foreach ($request->options as $i => $opt) {
                if (empty($opt['title_en']) && empty($opt['title_id']) && empty($opt['option_en'])) {
                    continue;
                }
                $product->options()->create([
                    'title_en' => $opt['title_en'] ?? 'Option',
                    'title_id' => $opt['title_id'] ?? ($opt['title_en'] ?? 'Option'),
                    'option_en' => $opt['option_en'] ?? '',
                    'option_id' => $opt['option_id'] ?? ($opt['option_en'] ?? ''),
                    'price' => !empty($opt['price']) ? $opt['price'] : 0,
                    'description_en' => $opt['description_en'] ?? null,
                    'description_id' => $opt['description_id'] ?? null,
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $product->load('options');
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
            'tokopedia_url' => 'nullable|string',
            'shopee_url' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'image_url_input' => 'nullable|string',
            'tip_size' => 'nullable|string',
            'joint_type' => 'nullable|string',
            'weight_oz' => 'nullable|string',
            'tip' => 'nullable|string',
            'ferrule' => 'nullable|string',
            'is_featured' => 'nullable',
            'is_active' => 'nullable',
            'options' => 'nullable|array',
        ]);

        if (!empty($data['tokopedia_url']) && !str_starts_with($data['tokopedia_url'], 'http://') && !str_starts_with($data['tokopedia_url'], 'https://')) {
            $data['tokopedia_url'] = 'https://' . $data['tokopedia_url'];
        }
        if (!empty($data['shopee_url']) && !str_starts_with($data['shopee_url'], 'http://') && !str_starts_with($data['shopee_url'], 'https://')) {
            $data['shopee_url'] = 'https://' . $data['shopee_url'];
        }

        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        } elseif ($request->filled('image_url_input')) {
            $data['image_path'] = $request->image_url_input;
        }

        $product->update($data);

        $submittedIds = [];
        if ($request->filled('options')) {
            foreach ($request->options as $i => $opt) {
                if (empty($opt['title_en']) && empty($opt['title_id']) && empty($opt['option_en'])) {
                    continue;
                }
                if (!empty($opt['id'])) {
                    $option = ProductOption::find($opt['id']);
                    if ($option && $option->product_id === $product->id) {
                        $option->update([
                            'title_en' => $opt['title_en'] ?? 'Option',
                            'title_id' => $opt['title_id'] ?? ($opt['title_en'] ?? 'Option'),
                            'option_en' => $opt['option_en'] ?? '',
                            'option_id' => $opt['option_id'] ?? ($opt['option_en'] ?? ''),
                            'price' => !empty($opt['price']) ? $opt['price'] : 0,
                            'description_en' => $opt['description_en'] ?? null,
                            'description_id' => $opt['description_id'] ?? null,
                            'sort_order' => $i,
                        ]);
                        $submittedIds[] = $option->id;
                    }
                } else {
                    $new = $product->options()->create([
                        'title_en' => $opt['title_en'] ?? 'Option',
                        'title_id' => $opt['title_id'] ?? ($opt['title_en'] ?? 'Option'),
                        'option_en' => $opt['option_en'] ?? '',
                        'option_id' => $opt['option_id'] ?? ($opt['option_en'] ?? ''),
                        'price' => !empty($opt['price']) ? $opt['price'] : 0,
                        'description_en' => $opt['description_en'] ?? null,
                        'description_id' => $opt['description_id'] ?? null,
                        'sort_order' => $i,
                    ]);
                    $submittedIds[] = $new->id;
                }
            }
        }
        $product->options()->whereNotIn('id', $submittedIds)->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->options()->delete();
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
