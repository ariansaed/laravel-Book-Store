@extends('admin.layouts.app')
    <script src="{{ asset('Admin-dist/js/create-form.js') }}"></script>
@section('content')
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-50 margin-bottom-15 border-radius-3">
            </div>
            <div class="col-6 bg-white">
                <p class="box__title"> ایجاد گروه بندی </p>
                <form id="store-form" action="{{ route('admin.categories.store') }}" method="post" class="padding-30">
                    @csrf
                    <input type="text" name="name" required placeholder=" عنوان " class="text">
                    <input type="submit" id="addCategory" class="btn btn-netcopy_net" value="اضافه کردن">
                </form>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.getElementById("categoryForm").addEventListener("submit", function(e) {
                        e.preventDefault(); // جلوگیری از رفرش صفحه
                        Swal.fire({
                            title: "موفق",
                            text: "دسته بندی ایجاد شد",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // بعد از نمایش پیام، فرم رو submit واقعی کن
                        setTimeout(() => {
                            e.target.submit();
                        }, 1500); // زمان SweetAlert
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
