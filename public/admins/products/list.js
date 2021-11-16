$(function () {
    $(".action_btn_delete").on("click", function () {
        let dataUrl = $(this).attr("data-url");
        let _this = $(this);
        Swal.fire({
            title: "Are you sure?",
            text: "Bạn muốn xóa sản phẩm này không?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "GET",
                    url: dataUrl,
                    success: function (data) {
                        _this.parent().parent().remove();
                        if (data.code === 200) {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    "Deleted!",
                                    "Your file has been deleted.",
                                    "success"
                                );
                            }
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });
            }
        });
    });
});
