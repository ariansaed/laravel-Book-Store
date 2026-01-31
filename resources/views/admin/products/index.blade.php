@extends('admin.layouts.app')
@section('script')
    <script src="{{ asset('Admin-dist/js/form-scripts.js') }}"></script>
@endsection
@section('content')
    <a href="{{ route('admin.products.index', ['type' => 'deleted']) }}" class="delete-restore btn"> لیست حذف شده ها</a>
    <div class="table__box">
        <table class="table">
            <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>نام </th>
                    <th>تصویر </th>
                    <th> دسته بندی </th>
                    <th>قیمت</th>
                    <th>موجودی</th>
                    <th>تاریخ</th>
                    <th>درج کننده</th>
                    <th>حذف</th>
                    <th>ویرایش</th>
                </tr>
            </thead>
            <tbody>
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <tr role="row">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $product->image) }}" style="max-width: 90px;"
                                    alt="{{ $product->image }}">
                            </td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ number_format($product->price) }}</td>
                            <td>{{ number_format($product->stock) }}</td>
                            <td>{{ $product->crated_at }}</td>
                            <th>{{ $product->user->name }}</th>
                            <td>
                                @if ($product->trashed())
                                    <a href="#" data-url="{{ route('admin.products.restore', $product->slug) }}"
                                        class="mlg-15 restore-item">بازگرداندن</a>
                                @else
                                    <a href="#" data-url="{{ route('admin.products.destroy', $product) }}"
                                        class="item-delete mlg-15 delete-item" title="حذف"></a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product) }}" class="item-edit"
                                    title="ویرایش"></a>
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
