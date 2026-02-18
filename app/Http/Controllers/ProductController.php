<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        if (isset($data['category'])) {
            $products = product::whereHas('category', function ($q) use ($data) {
                $q->where('slug', $data['category']);
            })->latest()->get();
        } else {
            $products = product::latest()->get();
        }

        return view('home.products.index', compact('products'));
    }
    public function show(product $product)
    {
        return view('home.products.show',compact('product'));
    }
}
