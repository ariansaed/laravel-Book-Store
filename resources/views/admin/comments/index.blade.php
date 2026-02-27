@extends('admin.layouts.app')
@section('script')
    <script src="{{ asset('Admin-dist/js/form-scripts.js') }}"></script>
@endsection
@section('content')
    <div class="table__box">
        <table class="table">
            <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>کاربر </th>
                    <th>محصول</th>
                    <th>نظر</th>
                    <th>تاریخ</th>
                </tr>
            </thead>
            <tbody>
                @if ($comments->count() > 0)
                    @foreach ($comments as $comment)
                        <tr role="row">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ $comment->product->name }}</td>
                            <td>{{ $comment->message }}</td>
                            <td>{{ $comment->created_at }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center">خالی</td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
@endsection
