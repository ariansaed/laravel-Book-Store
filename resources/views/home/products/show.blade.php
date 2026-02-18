@extends('layouts.home')
<link rel="stylesheet" href="{{ asset('Book-dist/css/comment-style.css') }}">
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
        <div class="row">
            <div class="col-12">
                <div class="direct-chat-msg right border">
                    <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name float-right">سارا</span>
                        <span class="direct-chat-timestamp float-left">۲۳ Jan ۲:۰۵ pm</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="{{ asset('Book-dist/image/user.png') }}" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-container">
                    <form action="" class="w-100">
                        <h3>ارسال نظر</h3>
                        <span>نظر شما</span>
                        <textarea class="box"></textarea>
                        <button type="submit" class="btn">ثبت نظر</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
