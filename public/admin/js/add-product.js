$(document).ready(function () {
  $("#formAddProduct").on("submit", function (event) {
    event.preventDefault();
    let values = $("#formAddProduct").serialize();
    $.ajax({
      type: "post",
      url: "/project-shopping-website/admin/modules/category/add-product.php",
      contentType: "application/x-www-form-urlencoded;charset=UTF-8",
      data: { values },
      success: function (data) {
        $("#showNotification").modal("show");
        $(".content-notifation").html(data);
        setTimeout(function () {
          $("#showNotification").modal("hide");
          location.reload(); 
        }, 1000);
      },
    });
  });
});
