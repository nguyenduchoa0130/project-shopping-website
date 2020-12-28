$(document).ready(function () {
  $(".btn-change-product-image").on("click", function (event) {
    let src = this.children[0].src;
    $("#img-product-main").attr("src", src);
  });

  $("#formUpdateProduct").on("submit", function (event) {
    event.preventDefault();
    let values = $("#formUpdateProduct").serialize();
    $.ajax({
      type: "post",
      url:
        "/project-shopping-website/admin/modules/product/update-product.php",
      contentType: "application/x-www-form-urlencoded;charset=UTF-8",
      data: { values },
      success: function (data) {
          $("#product-notification").modal("show");
          $(".product-notifi-content").html(data);
          setTimeout(()=>{
            $("#product-notification").modal("hide");
            location.reload();
          }, 1000);
      }
    });
  });
});
