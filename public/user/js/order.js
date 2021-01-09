$(document).ready(function () {
  $("#order-cancel").on("shown.bs.modal", function (e) {
    let id_order = $(e.relatedTarget).data("id");
    let dataSend = [];
    $("#btn-cancel-order").on("click", function (e) {
      let check = true;
      let note = $("#order-note").val();
      dataSend.push(note);
      if (note.length === 0) {
        $("#order-notification").modal("show");
        $("#order-notification-body").html("Vui lòng nhập lý do hủy đơn hàng");
        setTimeout(() => {
          $("#order-notification").modal("hide");
        }, 1000);
        check = false;
      }
      if (check) {
        $.ajax({
          type: "post",
          url:
            "/project-shopping-website/admin/modules/orders/verify-order.php",
          data: { id_order, action: 4, dataSend },
          success: function (data) {
            let noti = JSON.parse(data);
            if (noti["noti_code"] !== 0) {
              $("#order-notification").modal("show");
              $("#order-notification-body").html(noti["message"]);
              setTimeout(() => {
                $("#order-notification").modal("hide");
                window.location.reload();
              }, 1000);
            }
          },
        });
      }
    });
  });
  $("#order-info").on("shown.bs.modal", function (e) {
    let id_order = $(e.relatedTarget).data("id");
    $.ajax({
      type: "post",
      url: "/project-shopping-website/admin/modules/orders/getOrderDetail.php",
      data: { id_order },
      success: function (data) {
        $("#order-info-body").html(data);
        $("#handle-order").remove();
      },
    });
  });
  $("#status-order").on("change", function (e) {
    let req = "currentUser";
    let status = Number.parseInt($(this).val());
    $.ajax({
      type: "post",
      url: "/project-shopping-website/modules/account/getSession.php",
      data: { req },
      success: function (data) {
        let user = JSON.parse(data);
        $.ajax({
          type: "post",
          url:
            "/project-shopping-website/modules/order/load-order-by-status.php",
          data: { id_user: user["id_user"], status },
          success: function (data) {
            $("#table-order-body").html(data);
          },
        });
      },
    });
  });
  $("#btn-find-order").on("click", function (e) {
    let req = "currentUser";
    let id_order = Number.parseInt($("#id-order").val());
    $.ajax({
      type: "post",
      url: "/project-shopping-website/modules/account/getSession.php",
      data: { req },
      success: function (data) {
        let user = JSON.parse(data);
        if (id_order === NaN) {
          $("#order-notification").modal("show");
          $("#order-notification-body").html("Vui lòng nhập mã đơn hàng");
        } else {
          $.ajax({
            type: "post",
            url:
              "/project-shopping-website/modules/order/find-order.php",
            data: {id_user: user["id_user"], id_order },
            success: function (data) {
              if (data === null) {
                $("#order-notification").modal("show");
                $("#order-notification-body").html("Không tìm thấy đơn hàng");
              } else {
                $("#table-order-body").html(data);
              }
            },
          });
        }
      },
    });
  });
});
