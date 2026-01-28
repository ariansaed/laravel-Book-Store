document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("update-form");
    if (!form) return;
    form.addEventListener("submit", async function (e) {
        e.preventDefault();
        const url = form.action;
        const formData = new FormData(form);
        // 👇 برای هماهنگی با route update
        formData.append("_method", "PUT");

        Swal.fire({
            title: "در حال بروزرسانی ...",
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
                    text: data.message,
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                }).then(() => {
                    location.reload();
                });
            } else {
                let errorsHtml = "";
                if (data.errors) {
                    errorsHtml =
                        '<ul style="text-align:right; padding-right:1em;">' +
                        Object.values(data.errors)
                            .flat()
                            .map((err) => `<li>${err}</li>`)
                            .join("") +
                        "</ul>";
                } else if (data.message) {
                    errorsHtml = `<p>${data.message}</p>`;
                } else {
                    errorsHtml = "<p>خطایی رخ داد. لطفاً دوباره تلاش کنید.</p>";
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
                text: "ارتباط با سرور برقرار نشد.",
                icon: "error",
                confirmButtonText: "باشه",
            });
            console.error(err);
        }
    });
});
