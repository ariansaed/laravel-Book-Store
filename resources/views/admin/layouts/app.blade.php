<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--    <meta name="viewport" content="width=device-width, initial-scale=1.0;"> --}}
    <title>قالب پنل مدیریت |نت کپی</title>

    <link rel="stylesheet" href="{{ asset('Admin-dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin-dist/css/responsive_991.css') }}" media="(max-width:991px)">
    <link rel="stylesheet" href="{{ asset('Admin-dist/css/responsive_768.css') }}" media="(max-width:768px)">
    <link rel="stylesheet" href="{{ asset('Admin-dist/css/font.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>

    @include('admin.layouts.sidebar')

    @include('admin.layouts.header')

    @yield('content')
</body>
<script src="{{ asset('Admin-dist/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('Admin-dist/js/js.js') }}"></script>
<script src="{{ asset('Admin-dist/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- @vite(['resources/js/app.js', 'resources/css/app.css']) --}}
@yield('script')
@section('script')
    <script src="{{ asset('Admin-dist/js/form-scripts.js') }}"></script>
@endsection

</html>
