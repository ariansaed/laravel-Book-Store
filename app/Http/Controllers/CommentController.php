<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\Comment;

use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreComment $request)
    {
        Comment::create([
            'message' => $request->message,
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
        ]);
        $message = 'نظر شما بعد از تایید نمایش داده میشود';
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
            ], 201);
        }
    }
}
