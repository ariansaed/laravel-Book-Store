<!DOCTYPE html>
<html dir="rtl" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> فروشگاه آنلاین کتاب </title>
    <link rel="stylesheet" href="{{asset('Bootstrap/bootstrap.rtl.min.css')}}">
    {{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"--}}
    {{--          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="{{asset('Bootstrap/bootstrap.swiper.bundle.css')}}">
    {{--    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>--}}
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{asset('Book-dist/css/style.css')}}">
</head>
<body>
<!-- header section starts  -->
@include('front.Header')
<!-- login form  -->
@yield('content')

@include('front.Footer')
<!-- footer section ends -->
<!-- loader  -->
{{-- <div class="loader-container">
    <img src="{{asset('Book-dist/image/loader-img.gif')}}" alt="">
</div> --}}
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<!-- custom js file link  -->
<script src="{{asset('Book-dist/js/script.js')}}"></script>
</body>
</html>
