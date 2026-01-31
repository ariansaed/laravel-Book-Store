@extends('admin.layouts.app')
@section('script')
    <script src="{{ asset('Admin-dist/js/update-form.js') }}"></script>
@endsection
@section('content')
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-50 margin-bottom-15 border-radius-3">
            </div>
            <div class="col-6 bg-white">
                <p class="box__title"> ایجاد محصول </p>
                <form id="update-form" action="{{ route('admin.products.update', $product) }}" method="post" class="padding-30"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label for="inputName">نام محصول</label>
                    <input type="text" name="name" value="{{ $product->name }}" id="inputName" required
                        placeholder=" نام محصول " class="text">
                    <label for="inputCategory">دسته بندی</label>
                    <select name="category_id" id="inputCategory" class="text" required>
                        <option value="">دسته بندی را انتخاب کنید</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}> {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="inputImage">عکس محصول</label>
                    <input type="file" name="image" id="inputImage" placeholder=" عکس " class="text">
                    <label for="inputDescription">توضیحات</label>
                    <textarea type="text" id="inputDescription" style="max-width: 100%; max-height: 100px" name="description" required
                        placeholder=" توضیحات " class="text">{{ $product->description }}</textarea>
                    <label for="inputPrice">قیمت محصول</label>
                    <input type="text" name="price" value="{{ $product->price }}" id="inputPrice" required
                        placeholder=" قیمت " class="text only-number">
                    <label for="inputStock"> موجودی</label>
                    <input type="text" name="stock" value="{{ $product->stock }}" id="inputStock" required
                        placeholder=" موجودی " class="text only-number">
                    <input type="submit" class="btn btn-netcopy_net" value="اضافه کردن">
                </form>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.querySelectorAll('.only-number').forEach(function(input) {
                        input.addEventListener('input', function() {
                            this.value = this.value.replace(/[^0-9]/g, '');
                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
