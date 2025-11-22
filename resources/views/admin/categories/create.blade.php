@extends('admin.layouts.app')
@section('content')
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-50 margin-bottom-15 border-radius-3">
            </div>
            <div class="col-6 bg-white">
                <p class="box__title">ایجاد کاربر </p>
                <form action="{{route('admin.users.store')}}" method="post" class="padding-30">
                    @csrf
                    <input type="text" name="name" required placeholder=" نام کاربر را وارد کنید" class="text">
                    <input type="email" name="email" required placeholder="ایمیل را وارد کنید" class="text">
                    <input type="password" name="password" required placeholder="رمز عبور را وارد کنید" class="text">
                    <input type="password" name="confirm-pass" required placeholder="تایید رمز عبور را وارد کنید"
                           class="text">
                    <a href="#">
                        <button class="btn btn-netcopy_net">اضافه کردن</button>
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
