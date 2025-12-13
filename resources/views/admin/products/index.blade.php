@extends('admin.layouts.app')
@section('script')
@endsection
@section('content')
    <a href="{{ route('admin.products.index', ['type' => 'deleted']) }}" class="delete-restore btn"> لیست حذف شده ها</a>
    <div class="table__box">
        <table class="table">
            <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>نام </th>
                    <th> گروه</th>
                    <th>قیمت</th>
                    <th>موجودی</th>
                    <th>تاریخ</th>
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
                            <td>-</td>
                            <td>{{ number_format($product->price) }}</td>
                            <td>{{ number_format($product->stock) }}</td>
                            <td>{{ $product->crated_at }}</td>
                            <td>
                                @if ($product->trashed())
                                    <a href="#" data-url="{{ route('admin.categories.restore', $product) }}"
                                        class="mlg-15 delete-item restore-item">بازگرداندن</a>
                                @else
                                    <a href="#" data-url="{{ route('admin.categories.destroy', $product) }}"
                                        class="item-delete mlg-15 delete-item" title="حذف"></a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $product) }}" class="item-edit"
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
