<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\product;
use App\Models\User;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        if (isset($data['type']) && $data['type'] == 'deleted') {
            $products = product::onlyTrashed()->latest()->get();
        } else {
            $products = product::latest()->get();
        }
        return view('admin.products.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }
    public function store(StoreProductRequest $request)
    {
        try {
            $data = $request->validated();
            $data['slug'] = Str::slug($data['name']);
            $data['user_id'] = auth()->id();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('products', 'public');
            }
            $product = Product::create($data);
            $message = 'محصول با موفقیت ایجاد شد';
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => $message,
                ], 201);
            }
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            Log::error('خطا در ایجاد محصول: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            $errorMessage = 'خطایی در ایجاد محصول رخ داد. لطفاً دوباره تلاش کنید.';
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $errorMessage,
                ], 500);
            }

            return redirect()->back()->with('error', $errorMessage);
        }
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        //
    }
    public function destroy(string $id)
    {
        //
    }
}
