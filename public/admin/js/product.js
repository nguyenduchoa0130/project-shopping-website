$(document).ready(function () {
  $(".btn-change-product-image").on("click", function (event) {
    let src = this.children[0].src;
    $("#img-product-main").attr("src", src);
  });
  $("#product-verifyDelete").on("shown.bs.modal", function (e) {
    $("#btn-delete-product").on("click", function (e) {
      let id = $(this).data("id").toString();
      $.ajax({
        type: "post",
        url:
          "/project-shopping-website/admin/modules/product/remove-product.php",
        data: { id },
        success: function (data) {
          $("#product-notification-content").html(data);
          $("#product-notification").modal("show");
          setTimeout(() => {
            $("#product-notification").modal("hide");
            window.history.back();
          }, 1000);
        },
      });
    });
  });
});
