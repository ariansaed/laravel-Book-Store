@extends('layouts.home')
<link rel="stylesheet" href="{{ asset('Book-dist/css/comment-style.css') }}">
<script src="{{ asset('Book-dist/js/create-form.js') }}"></script>
@section('content')
    <!-- deal section starts  -->
    <section class="deal">
        <div class="content">
            <h3>{{ $product->name }} </h3>
            <p> {{ $product->description }} </p>
            <p style="font-size: 15px;">قیمت: {{ number_format($product->price) }} تومان</p>
            @if ($product->stock > 0)
                <a href="#" class="btn">اضافه کردن به سبد خرید</a>
            @else
                <a href="#" class="btn btn-danger">اتمام موجودی</a>
            @endif
        </div>
        <div class="image">
            <img style="max-width: 250px" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        </div>
    </section>
    <!-- deal section ends -->

    <section id="comments">
        <h2>نظرات شما </h2>
        <div style="border: 1px solid #cdcdcd; padding: 10px;" class="row">
            @foreach ($product->comment as $comment)
                <div class="col-12">
                    <div class="direct-chat-msg right border">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name float-right">{{ $comment->user->name }}</span>
                            <span class="direct-chat-timestamp float-left">{{ $comment->created_at }}</span>
                        </div>
                        <!-- /.direct-chat-info -->
                        <img class="direct-chat-img" src="{{ asset('Book-dist/image/user.png') }}" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            {{ $comment->message }}
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12">
                @auth
                    <div class="form-container">
                        <form id="store-form" action="{{ route('comment.store') }}" enctype="multipart/form-data"
                            method="post" class="w-100">
                            @csrf
                            <h3>ارسال نظر</h3>
                            <span>نظر شما</span>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <textarea required name="message" class="box"></textarea>
                            <button type="submit" class="btn">ثبت نظر</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" type="submit" class="btn">برای ثبت نطر ابتدا وارد شوید </a>
                @endauth
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
