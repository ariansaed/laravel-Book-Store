<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\product;
use App\Models\User;
use App\Models\category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        if (isset($data['type']) && $data['type'] == 'deleted') {
            $products = Product::onlyTrashed()->with('category', 'user')->latest()->get();
        } else {
            $products = Product::with('category', 'user')->latest()->get();
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
            $data['user_id'] = Auth::id();
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
    public function edit(product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            // ✅ بروزرسانی محصول
            $data = $request->validated();
            $product->update($data);
            return response()->json([
                'status'  => 'success',
                'message' => 'محصول با موفقیت ویرایش شد',
            ], 200);
        } catch (\Throwable $e) {
            // ✅ لاگ برای دیباگ
            Log::error('خطا در بروزرسانی محصول', [
                'product_id' => $product->id,
                'error'      => $e->getMessage(),
                'trace'      => $e->getTraceAsString(),
            ]);
            return response()->json([
                'status'  => 'error',
                'message' => 'خطایی در ویرایش محصول رخ داد. لطفاً دوباره تلاش کنید.',
            ], 500);
        }
    }
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'محصول با موفقیت حذف شد',
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در حذف محصول',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function restore($slug)
    {
        $product = Product::onlyTrashed()->where('slug', $slug)->first();
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'آیتم مورد نظر یافت نشد',
            ], 404);
        }
        $product->restore();
        return response()->json([
            'success' => true,
            'message' => 'محصول با موفقیت بازیابی شد',
        ], 200);
    }
}
