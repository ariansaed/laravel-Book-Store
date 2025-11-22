@extends('admin.layouts.app')
@section('content')
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-50 margin-bottom-15 border-radius-3">
            </div>
            <div class="col-6 bg-white">
                <p class="box__title">ایجاد کاربر </p>
                <form id="userform" action="{{ route('admin.users.store') }}" method="POST" class="padding-30">
                    @csrf
                    <input type="text" name="name" required placeholder="نام کاربر را وارد کنید" class="text">
                    <input type="email" name="email" required placeholder="ایمیل را وارد کنید" class="text">
                    <input type="password" name="password" required placeholder="رمز عبور را وارد کنید" class="text">
                    <input type="password" name="password_confirmation" required placeholder="تأیید رمز عبور را وارد کنید"
                        class="text">
                    <select name="role" required>
                        <option value="user">کاربر عادی</option>
                        <option value="admin">ادمین</option>
                    </select>
                    <input type="submit" class="btn btn-netcopy_net" value="اضافه کردن">
                </form>
                <script>
                    document
                        .getElementById("userform")
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
                                        text: data.message || "عملیات با موفقیت انجام شد.",
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
