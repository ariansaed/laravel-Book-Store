$(document).ready(function () {
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
                            "content",
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
});
// بازگردانی آیتم
$("body").on("click", ".restore-item", function (e) {
    e.preventDefault();

    const trashRow = $(this).closest("tr");
    const action = $(this).data("url");

    Swal.fire({
        title: "بازگردانی آیتم",
        text: "آیا مطمئن هستید که می‌خواهید این آیتم بازگردانی شود؟",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "بله، بازگردانی کن!",
        cancelButtonText: "انصراف",
    }).then((result) => {
        if (!result.isConfirmed) return;

        $.ajax({
            url: action,
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                Swal.fire("بازگردانی شد!", response.message, "success");

                // هایلایت ردیف در جدول Trash قبل از انتقال
                highlightRow(trashRow, "#d4edda");

                // حذف ردیف از جدول Trash
                trashRow.fadeOut(400, function () {
                    $(this).remove();
                });

                // آماده سازی ردیف برای جدول اصلی
                const newRow = $(response.row_html); // فرض: سرور HTML ردیف کامل برمی‌گردونه

                // اضافه کردن دکمه حذف با کلاس delete-item
                newRow
                    .find(".restore-item")
                    .removeClass("restore-item btn-success")
                    .addClass("delete-item btn-danger")
                    .attr("title", "حذف")
                    .data("url", response.delete_url)
                    .html('<i class="fa fa-trash"></i>');

                // اضافه کردن ردیف به جدول اصلی بدون reload
                $("#main-table tbody").prepend(newRow);

                // هایلایت کوتاه ردیف جدید
                highlightRow(newRow, "#d4edda");
            },
            error: function (xhr) {
                const res = xhr.responseJSON;
                Swal.fire(
                    "خطا!",
                    res?.message || "خطایی رخ داد. دوباره تلاش کنید.",
                    "error",
                );
            },
        });
    });
});

// تابع highlight اختیاری برای جلب توجه
function highlightRow(row, color = "#d4edda") {
    const original = row.css("background-color");
    row.css("background-color", color);
    setTimeout(() => row.css("background-color", original), 1200);
}
