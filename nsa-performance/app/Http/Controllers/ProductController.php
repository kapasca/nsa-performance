<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function featured()
    {
        return Product::where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }
}
