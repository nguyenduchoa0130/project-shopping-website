$(document).ready(function () {
  $("#btn-dislike").on("click", function (e) {
    let req = "currentUser";
    $.ajax({
      type: "post",
      url: "/project-shopping-website/modules/account/getSession.php",
      data: { req },
      success: function (data) {
        if (data === null) {
          $("#product-notification-modal").modal("show");
        } else {
          let user = JSON.parse(data);
          let id_product = $("#btn-dislike").data("id");
          $.ajax({
            type: "post",
            url: "/project-shopping-website/modules/like/dislike.php",
            data: { id_user: user["id_user"], id_product: id_product },
            success: function (data) {
              let noti = JSON.parse(data);
              if (noti["noti_code"] !== 0) {
                location.reload();
              }
            },
          });
        }
      },
    });
  });
});
