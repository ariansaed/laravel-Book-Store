$(document).ready(function () {
    // تابع helper برای highlight کردن ردیف
    function highlightRow(row, color = "#d4edda") {
        row.css("background-color", color);
        setTimeout(() => {
            row.css("background-color", "");
        }, 1000); // 1 ثانیه بعد رنگ برمی‌گرده به حالت عادی
    }
    // حذف آیتم
    $("body").on("click", ".delete-item", function (e) {
        e.preventDefault();

        const action = $(this).data("url");
        const row = $(this).closest("tr");

        Swal.fire({
            title: "آیا مطمئنی؟",
            text: "این آیتم حذف خواهد شد!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "بله، حذفش کن!",
            cancelButtonText: "انصراف",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: action,
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        Swal.fire("حذف شد!", response.message, "success");
                        // انیمیشن حذف
                        row.fadeOut(500, function () {
                            $(this).remove();
                        });
                    },
                    error: function (response) {
                        response = response.responseJSON;
                        Swal.fire("خطا!", response.message, "error");
                    },
                });
            }
        });
    });

    // بازگردانی آیتم
    $("body").on("click", ".restore-item", function (e) {
        e.preventDefault();

        const action = $(this).data("url");
        const row = $(this).closest("tr");

        Swal.fire({
            title: "بازگردانی آیتم",
            text: "این آیتم بازگردانی خواهد شد!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "بله، بازگردانی کن!",
            cancelButtonText: "انصراف",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: action,
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        Swal.fire("بازگردانی شد!", response.message, "success");

                        // highlight ردیف برای جلب توجه
                        highlightRow(row, "#d4edda");

                        // تغییر لینک و کلاس‌ها بدون reload
                        row.find(".restore-item")
                            .removeClass("restore-item")
                            .addClass("delete-item")
                            .attr("title", "حذف")
                            .data("url", response.delete_url) // مطمئن شو URL حذف برگشت داده شده
                            .html('<i class="fa fa-trash"></i>');
                    },
                    error: function (response) {
                        response = response.responseJSON;
                        Swal.fire("خطا!", response.message, "error");
                    },
                });
            }
        });
    });
});
// اسکریپت فرم ایجاد کاربر
document
    .getElementById("userform")
    .addEventListener("submit", async function (e) {
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
