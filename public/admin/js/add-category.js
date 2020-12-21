$(document).ready(function () {
  $("#formAddCategory").on("submit", function (event) {
    event.preventDefault();
    let values = $("#formAddCategory").serialize();
    $.ajax({
      type: "post",
      url: "/project-shopping-website/admin/modules/category/add-category.php",
      contentType: "application/x-www-form-urlencoded;charset=UTF-8",
      data: { values },
      success: function (data) {
        $("#showNotification").modal("show");
        $(".content-notifation").html(data);
        setTimeout(function () {
          $("#showNotification").modal("hide");
          location.reload();
        }, 2000);
      },
    });
  });
});
