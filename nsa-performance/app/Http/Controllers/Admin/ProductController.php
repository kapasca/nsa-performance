<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'discount_price' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'is_featured' => 'nullable|boolean'
        ]);

        // Upload image
        $imageName = time() . '_' . $request->image->getClientOriginalName();
        $request->image->move(public_path('assets/images/products'), $imageName);

        Product::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'price' => $validated['price'],
            'discount_price' => $validated['discount_price'],
            'description' => $validated['description'],
            'image' => $imageName,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'discount_price' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_featured' => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('assets/images/products'), $imageName);
            $product->image = $imageName;
        }

        $product->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'price' => $validated['price'],
            'discount_price' => $validated['discount_price'],
            'description' => $validated['description'],
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function toggleFeatured(Product $product)
    {
        $product->update([
            'is_featured' => ! $product->is_featured
        ]);

        return response()->json([
            'success' => true,
            'is_featured' => $product->is_featured
        ]);
    }
}
