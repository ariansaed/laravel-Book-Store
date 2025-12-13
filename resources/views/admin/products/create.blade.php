@extends('admin.layouts.app')
@section('content')
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-50 margin-bottom-15 border-radius-3">
            </div>
            <div class="col-6 bg-white">
                <p class="box__title"> ایجاد محصول </p>
                <form id="productForm" action="{{ route('admin.products.store') }}" method="post" class="padding-30">
                    @csrf
                    <label for="inputName">نام محصول</label>
                    <input type="text" name="name" id="inputName" required placeholder=" نام محصول " class="text">
                    <label for="inputCategory">دسته بندی</label>
                    <select name="category_id" id="inputCategory" class="text" required>
                        <option value="">دسته بندی را انتخاب کنید</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                        @endforeach
                    </select>
                    <label for="inputImage">عکس محصول</label>
                    <input type="file" name="image" id="inputImage" placeholder=" عکس " class="text">
                    <label for="inputDescription">توضیحات</label>
                    <textarea type="text" id="inputDescription" style="max-width: 100%; max-height: 100px" name="description" required
                        placeholder=" توضیحات " class="text"></textarea>
                    <label for="inputPrice">قیمت محصول</label>
                    <input type="text" name="price" id="inputPrice" required placeholder=" قیمت "
                        class="text only-number">
                    <label for="inputStock"> موجودی</label>
                    <input type="text" name="stock" id="inputStock" required placeholder=" موجودی "
                        class="text only-number">
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
                <script>
                    document
                        .getElementById("productForm")
                        .addEventListener("submit", async function(e) {
                            e.preventDefault();

                            const form = e.target;
                            const url = form.action;
                            const formData = new FormData(form);

                            Swal.fire({
                                title: "در حال ارسال ...",
                                allowOutsideClick: false,
                                didOpen: () => Swal.showLoading(),
                            });

                            try {
                                const token = document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute("content");

                                const response = await fetch(url, {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": token,
                                        Accept: "application/json",
                                    },
                                    body: formData,
                                });

                                const data = await response.json().catch(() => ({}));

                                Swal.close();

                                if (response.ok && data.status === "success") {
                                    Swal.fire({
                                        title: "موفق!",
                                        text: data.message || "محصول با موفقیت اضافه شد.",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    }).then(() => {
                                        form.reset();
                                    });
                                } else {
                                    let errorsHtml = "";
                                    if (data.errors && Array.isArray(data.errors)) {
                                        errorsHtml =
                                            '<ul style="text-align: right; padding-right: 1em;">' +
                                            data.errors
                                            .map((err) => "<li>" + err + "</li>")
                                            .join("") +
                                            "</ul>";
                                    } else if (data.message) {
                                        errorsHtml = "<p>" + data.message + "</p>";
                                    } else {
                                        errorsHtml = "<p>خطایی رخ داد. لطفا دوباره تلاش کنید.</p>";
                                    }

                                    Swal.fire({
                                        title: "خطا!",
                                        html: errorsHtml,
                                        icon: "error",
                                        confirmButtonText: "باشه",
                                    });
                                }
                            } catch (err) {
                                Swal.close();
                                Swal.fire({
                                    title: "خطای شبکه",
                                    text: "ارتباط با سرور برقرار نشد. اینترنت یا سرور را بررسی کنید.",
                                    icon: "error",
                                    confirmButtonText: "باشه",
                                });
                                console.error(err);
                            }
                        });
                </script>
            </div>
        </div>
    </div>
@endsection
