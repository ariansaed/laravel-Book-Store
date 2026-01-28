document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("store-form");
    if (!form) return;
    form.addEventListener("submit", async function (e) {
        e.preventDefault();
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
                ?.getAttribute("content");
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
                    text: data.message || "عملیات با موفقیت اضافه شد.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                }).then(() => {
                    form.reset();
                });
            } else {
                let errorsHtml = "";
                if (data.errors) {
                    errorsHtml =
                        '<ul style="text-align: right; padding-right: 1em;">' +
                        Object.values(data.errors)
                            .flat()
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
});
