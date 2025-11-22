<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        try {
            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => $request->input('role', 'user'),
            ]);
            $message = 'کاربر با موفقیت ایجاد شد';
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status'  => 'success',
                    'message' => $message,
                ], 201);
            }
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            Log::error('User creation failed: ' . $e->getMessage());

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'خطایی در ایجاد کاربر رخ داد. لطفاً دوباره تلاش کنید.'
                ], 500);
            }
            return redirect()->back()->with('error', 'خطایی رخ داد. لطفاً دوباره تلاش کنید.');
        }
    }
    public function show(string $id)
    {
        //
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            $role = $request->input('role', 'user');
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->role = $role;
            if (!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }
            $user->save();
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'اطلاعات با موفقیت ویرایش شد.');
        } catch (\Throwable $th) {
            Log::error('User Update Error: ' . $th->getMessage());
            return redirect()
                ->back()
                ->with('error', 'خطا در ویرایش اطلاعات!');
        }
    }

    public function destroy(User $user)
    {
        if (!$user) {
            return response()->json([
                'success' => true,
                'message' => ' !آیتم مورد نظر یافت نشد',
            ], 404);
        }
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'کاربر با موفقیت حذف شد.',
        ]);
    }

    public function restore($userId)
    {
        $user = User::withTrashed()->find($userId);
        if (!$user) {
            return response()->json([
                'success' => true,
                'message' => ' !آیتم مورد نظر یافت نشد',
            ], 404);
        }
        $user->restore();
        return response()->json([
            'success' => true,
            'message' => 'کاربر با موفقیت بازیابی شد.',
        ]);
    }
}
