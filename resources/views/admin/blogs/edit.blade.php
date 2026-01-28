@extends('admin.layouts.app')
<script src="{{ asset('Admin-dist/js/update-form.js') }}"></script>
@section('content')
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-50 margin-bottom-15 border-radius-3">
            </div>
            <div class="col-6 bg-white">
                <p class="box__title">ویرایش مطلب</p>
                <form id="update-form" action="{{ route('admin.blogs.update', $blog) }}" method="post"
                    class="padding-30">
                    @csrf
                    @method('PUT')
                   <label for="inputName">نام عنوان</label>
                    <input type="text" value="{{ $blog->name }}" name="name" id="inputName" required placeholder=" نام عنوان " class="text">
                    <label for="inputImage">عکس بلاگ</label>
                    <input type="file" name="image" id="inputImage" placeholder=" عکس " class="text">
                    <label for="inputDescription">توضیحات</label>
                    <textarea type="text" id="inputDescription" style="max-width: 100%; max-height: 100px" name="description" required
                        placeholder=" توضیحات " class="text">{{ $blog->description }}</textarea>
                    <input type="submit" class="btn btn-netcopy_net" value="اضافه کردن">
                </form>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </div>
        </div>
    </div>
@endsection
