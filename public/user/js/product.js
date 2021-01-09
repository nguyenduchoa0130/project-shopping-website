$(document).ready(function () {
  $("#btn-like").on("click", function (e) {
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
          let id_product = $("#btn-like").data("id");
          $.ajax({
            type: "post",
            url: "/project-shopping-website/modules/like/add-like.php",
            data: { id_user: user["id_user"], id_product: id_product },
            success: function (data) {
              let noti = JSON.parse(data);
              if (noti["noti_code"] !== 0) {
                $("#toast-notification-body").html(noti["message"]);
                $("#toast-notification").toast("show");
              }
            },
          });
        }
      },
    });
  });

  $("#btn-add-to-cart").on("click", function (e) {
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
          let id_product = $("#btn-add-to-cart").data("id");
          let quantity = $("#quantity").val();
          $.ajax({
            type: "post",
            url: "/project-shopping-website/modules/cart/add-to-cart.php",
            data: {
              id_user: user["id_user"],
              id_product: id_product,
              quantity: quantity,
            },
            success: function (data) {
              let noti = JSON.parse(data);
              if (noti["noti_code"] !== 0) {
                $("#toast-notification-body").html(noti["message"]);
                $("#toast-notification").toast("show");
              }
            },
          });
        }
      },
    });
  });
  $("#form-review").on("submit", function (e) {
    e.preventDefault();
    let req = "currentUser";
    let dataReview = $("#form-review").serialize();
    let id_product = $("#btn-review").data("id");
    $.ajax({
      type: "post",
      url: "/project-shopping-website/modules/account/getSession.php",
      data: { req },
      success: function (data) {
        let user = JSON.parse(data);
        let id_user = user["id_user"];
        $.ajax({
          type: "post",
          url: "/project-shopping-website/modules/product/add-review.php",
          data: { id_user, id_product, dataReview },
          success: function (data) {
            let noti = JSON.parse(data);
            $("#review-notification").modal("show");
            $("#review-notification-body").html(noti["message"]);
            setTimeout(() => {
              $("#review-notification").modal("hide");
              window.location.reload();
            }, 1000);
          },
        });
      },
    });
  });
});
