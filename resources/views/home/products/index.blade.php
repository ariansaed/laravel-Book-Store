@extends('layouts.home')

@section('content')
    <section class="arrivals" id="arrivals">
        <h1 class="heading"> <span>کتابهای جدید</span> </h1>
        <div class="swiper arrivals-slider">
            @foreach ($products as $product)
                <a href="{{ route('products.show', $product) }}" class="swiper-slide box swiper-slide-prev  "
                    style="width: 443px;float: right; margin-left: 5px;">
                    <div class="image">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="content">
                        <h3>{{ Str::limit($product->name, 20) }}</h3>
                        <div class="price">{{ number_format($product->price, 0) }} هزار تومان</div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endsection
