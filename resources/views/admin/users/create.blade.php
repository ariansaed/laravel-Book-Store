@extends('admin.layouts.app')
<script src="{{ asset('Admin-dist/js/form-scripts.js') }}"></script>
@section('content')
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-50 margin-bottom-15 border-radius-3">
            </div>
            <div class="col-6 bg-white">
                <p class="box__title">ایجاد کاربر </p>
                <form id="userform" action="{{ route('admin.users.store') }}" method="POST" class="padding-30">
                    @csrf
                    <input type="text" name="name" required placeholder="نام کاربر را وارد کنید" class="text">
                    <input type="email" name="email" required placeholder="ایمیل را وارد کنید" class="text">
                    <input type="password" name="password" required placeholder="رمز عبور را وارد کنید" class="text">
                    <input type="password" name="password_confirmation" required placeholder="تأیید رمز عبور را وارد کنید"
                        class="text">
                    <select name="role" required>
                        <option value="user">کاربر عادی</option>
                        <option value="admin">ادمین</option>
                    </select>
                    <input type="submit" class="btn btn-netcopy_net" value="اضافه کردن">
                </form>
            </div>
        </div>
    </div>
@endsection
