@extends('admin.layouts.app')
@section('script')
    <script src="{{ asset('Admin-dist/js/form-scripts.js') }}"></script>
@endsection
@section('content')
    <a href="{{ route('admin.blogs.index', ['type' => 'deleted']) }}" class="delete-restore btn"> لیست حذف شده ها</a>
    <div class="table__box">
        <table class="table">
            <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>نام </th>
                    <th> تصویر </th>
                    <th> توضیحات </th>
                    <th>حذف</th>
                    <th>ویرایش</th>
                </tr>
            </thead>
            <tbody>
                @if ($blogs->count() > 0)
                    @foreach ($blogs as $blog)
                        <tr role="row">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $blog->name }}</td>
                            <td>
                                @if ($blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->image }}" style="max-width: 100px;" />
                                @else
                                    بدون تصویر
                                @endif
                            </td>
                            <td>{{ $blog->description }}</td>
                            <td>
                                @if ($blog->trashed())
                                    <a href="#" data-url="{{ route('admin.blogs.restore', $blog) }}"
                                        class="mlg-15 restore-item">بازگرداندن</a>
                                @else
                                    <a href="#" data-url="{{ route('admin.blogs.destroy', $blog) }}"
                                        class="item-delete mlg-15 delete-item" title="حذف"></a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.blogs.edit', $blog) }}" class="item-edit" title="ویرایش"></a>
                            </td>
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
