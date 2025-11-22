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

