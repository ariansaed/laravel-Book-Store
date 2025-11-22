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
            return redirect()
                ->back()
                ->with('success', 'دسته بندی ایجاد شد');
        } catch (\Throwable $e) {
            Log::error('Category Store Error: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'خطا در ثبت اطلاعات!');
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
