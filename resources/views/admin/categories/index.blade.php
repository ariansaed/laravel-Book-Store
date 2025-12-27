@extends('admin.layouts.app')
@section('script')
    <script src="{{ asset('Admin-dist/js/form-scripts.js') }}"></script>
@endsection
@section('content')
    <a href="{{ route('admin.categories.index', ['type' => 'deleted']) }}" class="delete-restore btn"> لیست حذف شده ها</a>
    <div class="table__box">
        <table class="table">
            <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>نام گروه بندی</th>
                    <th> slug</th>
                    <th>حذف</th>
                    <th>ویرایش</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr role="row" class="">
                        <td><a href="">{{ $loop->index + 1 }}</a></td>
                        <td><a href="">{{ $category->name }}</a></td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            @if ($category->trashed())
                                <a href="#" data-url="{{ route('admin.categories.restore', $category) }}"
                                    class="mlg-15 restore-item">بازگرداندن </a>
                            @else
                                <a href="#" data-url="{{ route('admin.categories.destroy', $category) }}"
                                    class="item-delete mlg-15 delete-item" title="حذف">
                                </a>
                            @endif
                        </td>
                        <td><a href="{{ route('admin.categories.edit', $category) }}" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
