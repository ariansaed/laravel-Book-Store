<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        if (isset($data['type']) && $data['type'] == 'deleted') {
            $categories = category::onlyTrashed()->get();
        } else {
            $categories = Category::latest()->get();
        }

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        try {
            Category::create([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
            ]);
            $message = 'دسته بندی با موفقیت ایجاد شد';
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => $message,
                ], 201);
            }
            return redirect()->route('admin.categories.index')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('خطا در ایجاد دسته بندی: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            $errorMessage = 'خطایی در ایجاد دسته بندی رخ داد. لطفاً دوباره تلاش کنید.';
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

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        try {
            $data = $request->all();
            $category->name = $data['name'];
            $category->save();
            return redirect()->back()->with('success', 'اطلاعات با موفقیت ویرایش شد');
        } catch (\Throwable $e) {
            Log::error('Category Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'خطا در ویرایش اطلاعات!');
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'دسته‌بندی با موفقیت حذف شد'
        ]);
    }

    public function restore($category)
    {
        $category = category::onlyTrashed()->where('slug', $category)->first();
        if (!$category) {
            return response()->json([
                'success' => true,
                'message' => 'آیتم مورد نظر یافت نشد',
            ], 404);
        }
        $category->restore();
        return response()->json([
            'success' => true,
            'message' => 'دسته بندی با موفقیت بازیابی شد',
        ], 200);
    }
}
