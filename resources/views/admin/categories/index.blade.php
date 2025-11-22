@extends('admin.layouts.app')

@section('content')
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
            @foreach($users as $user)
                <tr role="row" class="">
                    <td><a href="">{{$loop->index+1}}</a></td>
                    <td><a href="">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>09276108107</td>
                    <td>
                        @if($user->role === 'admin')
                            ادمین
                        @else
                            کاربر عادی
                        @endif
                    </td>
                    <td>{{$user->created_at}}</td>
                    <td class="text-success">تاییده شده</td>
                    <td>
                        {{--                        <a href="{{route('admin.users.destroy',$user)}}" class="item-delete mlg-15" title="حذف"></a>--}}
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('آیا مطمئن هستید؟');">
                                <a href="{{route('admin.users.destroy',$user)}}" class="item-delete mlg-15"
                                   title="حذف"></a>
                            </button>
                        </form>
                        <a href="" class="item-confirm mlg-15" title="تایید"></a>
                        <a href="" class="item-reject mlg-15" title="رد"></a>
                        <a href="#" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                        <a href="{{route('admin.users.edit',$user)}}" class="item-edit " title="ویرایش"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
