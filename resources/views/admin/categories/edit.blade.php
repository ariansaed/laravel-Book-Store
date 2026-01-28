@extends('admin.layouts.app')
<script src="{{ asset('Admin-dist/js/update-form.js') }}"></script>
@section('content')
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-50 margin-bottom-15 border-radius-3">
            </div>
            <div class="col-6 bg-white">
                <p class="box__title"> ویرایش عنوان </p>
                <form id="update-form" action="{{ route('admin.categories.update', $category) }}" method="post" class="padding-30">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" value="{{ $category->name }}" required
                        placeholder="عنوان را وارد کنید" class="text">
                    <button type="submit" class="btn btn-netcopy_net">ویرایش دسته</button>
                </form>
            </div>
        </div>
    </div>
@endsection
