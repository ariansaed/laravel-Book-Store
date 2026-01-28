@extends('admin.layouts.app')
<script src="{{ asset('Admin-dist/js/create-form.js') }}"></script>
@section('content')
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-50 margin-bottom-15 border-radius-3">
            </div>
            <div class="col-6 bg-white">
                <p class="box__title"> ایجاد مطلب </p>
                <form id="store-form" action="{{ route('admin.blogs.store') }}" method="post" class="padding-30">
                    @csrf
                    <label for="inputName">نام عنوان</label>
                    <input type="text" required name="name" id="inputName" placeholder=" نام عنوان " class="text">
                    <label for="inputImage">عکس مطلب</label>
                    <input type="file" name="image" id="inputImage" placeholder=" عکس " class="text">
                    <label for="inputDescription">توضیحات</label>
                    <textarea type="text" required id="inputDescription" style="max-width: 100%; max-height: 100px" name="description"
                        placeholder=" توضیحات " class="text"></textarea>
                    <input type="submit" class="btn btn-netcopy_net" value="اضافه کردن">
                </form>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </div>
        </div>
    </div>
@endsection
