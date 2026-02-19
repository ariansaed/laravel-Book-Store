<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        if (isset($data['category'])) {
            $products = Product::whereHas('category', function ($q) use ($data) {
                $q->where('slug', $data['category']);
            })->latest()->get();
        } else {
            $products = Product::latest()->get();
        }

        return view('home.products.index', compact('products'));
    }
    public function show(Product $product)
    {
        $product->load('comment.user');
        return view('home.products.show',compact('product'));
    }
}
