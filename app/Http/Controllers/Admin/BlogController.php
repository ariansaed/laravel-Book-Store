<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpadateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        if (isset($data['type']) && $data['type'] == 'deleted') {
            $blogs = Blog::onlyTrashed()->latest()->get();
        } else {
            $blogs = Blog::latest()->get();
        }
        return view('admin.blogs.index', compact('blogs'));
    }
    public function create(Request $request)
    {
        return view('admin.blogs.create');
    }
    public function store(BlogStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $data['slug'] = Str::slug($data['name']);
            if ($request->hasFile('image')) {
                $data['image'] = UploadHelper::UploadImage($request->file('image'), 'blog_image');
            }
            Blog::create($data);
            $message = 'عملیات با موفقیت ایجاد شد';
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => $message,
                ], 201);
            }
            return redirect()->route('admin.blogs.index')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('خطا در ایجاد عملیات: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            $errorMessage = 'خطایی در ایجاد عملیات رخ داد. لطفاً دوباره تلاش کنید.';
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
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }
    public function update(BlogUpadateRequest $request, Blog $blog)
    {
        try {
            $data = $request->validated();
            $blog->name = $data['name'];
            $blog->description = $data['description'];
            if ($request->hasFile('image')) {
                $imagePath = UploadHelper::UploadImage($request->file('image'), 'blog_image');
                if ($blog->image) {
                    UploadHelper::DeleteImage($blog->image);
                }
                $blog->image = $imagePath;
            }
            $blog->save();
            return response()->json([
                'status' => 'success',
                'message' => 'ویرایش موفقیت آمیز'
            ]);
        } catch (\Throwable $e) {
            Log::error('خطا در بروزرسانی مطلب', [
                'error'      => $e->getMessage(),
                'trace'      => $e->getTraceAsString(),
            ]);
            return response()->json([
                'status'  => 'error',
                'message' => 'خطایی در ویرایش رخ داد. لطفاً دوباره تلاش کنید.',
            ], 500);
        }
    }
    public function destroy(Blog $blog)
    {
        try {
            $blog->delete();
            return response()->json([
                'success' => true,
                'message' => 'مطلب با موفقیت حذف شد'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در حذف مطلب'
            ], 404);
        }
    }
    public function restore($slug)
    {
        $blog = Blog::onlyTrashed()->where('slug', $slug)->first();
        if (!$blog) {
            return response()->json([
                'success' => false,
                'message' => 'آیتم مورد نظر یافت نشد',
            ], 404);
        }
        $blog->restore();
        return response()->json([
            'success' => true,
            'message' => 'مطلب با موفقیت بازیابی شد',
        ], 200);
    }
}
