<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // API method to get featured products on home page with pagination
    public function featured(Request $request)
    {
        $limit  = (int) $request->get('limit', 3);
        $offset = (int) $request->get('offset', 0);

        $products = Product::where('is_featured', true)
            ->latest()
            ->skip($offset)
            ->take($limit)
            ->get();

        $total = Product::where('is_featured', true)->count();

        return response()->json([
            'data' => $products,
            'total' => $total,
        ]);
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }
}
