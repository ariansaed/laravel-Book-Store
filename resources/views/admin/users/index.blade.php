@extends('admin.layouts.app')
@section('script')
    <script src="{{asset('Admin-dist/js/form-scripts.js')}}"></script>
@endsection
@section('content')
    <a href="{{ route('admin.users.index', ['type' => 'deleted']) }}" class="delete-restore btn"> لیست حذف شده ها</a>
    <div class="table__box">
        <table class="table">
            <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>نام و نام خانوادگی</th>
                    <th>ایمیل</th>
                    <th>شماره موبایل</th>
                    <th>سطح کاربری</th>
                    <th>تاریخ عضویت</th>
                    <th>وضعیت حساب</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr role="row" class="">
                        <td><a href="">{{ $loop->index + 1 }}</a></td>
                        <td><a href="">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>..09</td>
                        <td>
                            @if ($user->role === 'admin')
                                ادمین
                            @else
                                کاربر عادی
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td class="text-success">تاییده شده</td>
                        <td>

                            <a href="" class="item-confirm mlg-15" title="تایید"></a>
                            <a href="" class="item-reject mlg-15" title="رد"></a>
                            <a href="#" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                            @if ($user->trashed())
                                <a href="#" data-url="{{ route('admin.users.restore', $user) }}"
                                    class="mlg-15 restore-item">بازگرداندن </a>
                            @else
                                <a href="#" data-url="{{ route('admin.users.destroy', $user) }}"
                                    class="item-delete mlg-15 delete-item" title="حذف">
                                </a>
                            @endif
                            <a href="{{ route('admin.users.edit', $user) }}" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
