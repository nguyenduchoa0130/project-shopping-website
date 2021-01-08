$(document).ready(function () {
  $("#order-detail").on("shown.bs.modal", function (e) {
    let id_order = $(e.relatedTarget).data("id");
    let date_created = $(e.relatedTarget).data("date");
    let yearStart = date_created.substr(0, 4);
    let monthStart = date_created.substr(5, 2);
    let dayStart = date_created.substr(8, 2);
    let timeStart = yearStart + "-" + monthStart + "-" + dayStart;
    let action;
    $.ajax({
      type: "post",
      url: "/project-shopping-website/admin/modules/orders/getOrderDetail.php",
      data: { id_order },
      success: function (data) {
        $("#order-detail-body").html(data);
        $("#action-order").on("change", function (e) {
          action = Number.parseInt($(this).val());
          let form_group = $("#order-detail-body").find(".form-group");
          $(form_group).remove();
          if (action === 2) {
            $("#order-detail-body").append(
              ` <div class="form-group my-2">
                    <p>Định dạng: tháng/ngày/năm</p>
                    <label for='start'>Ngày đặt:</label>
                    <input type='date' id='start'
                           value='${timeStart}'
                            readonly>
                           <label for='start'>Ngày giao:</label>

                    <input type='date' id='end'
                            min='${timeStart} max='9999-12-31'>
                </div>
                `
            );
          } else if (action === 4) {
            $("#order-detail-body").append(
              `
                <div class="form-group my-2">
                    <label for="order-note" class="text-danger">Lý do:</label>
                    <textarea class="form-control" id="order-note" name="order-note" rows="3"></textarea>
                 </div>
               `
            );
          }
        });
        $("#btn-verify-order").on("click", function (e) {
          if (action === undefined) {
            $("#order-notification").modal("show");
            $("#order-notification-body").html(
              "Vui lòng chọn hình thức xử lý đơn hàng"
            );
            setTimeout(() => {
              $("#order-notification").modal("hide");
            }, 1500);
          } else {
            let check = true;
            let dataSend = [];
            if (action === 2) {
              dataSend.push($("#start").val());
              dataSend.push($("#end").val());
              let start = $("#start").val();
              let end = $("#end").val();
              if (end.length === 0) {
                $("#order-notification").modal("show");
                $("#order-notification-body").html(
                  "Vui lòng chọn ngày giao hàng"
                );
                setTimeout(() => {
                  $("#order-notification").modal("hide");
                }, 1500);
                check = false;
              } else {
                let a = new Date(start);
                let b = new Date(end);
                if (+b <= +a) {
                  $("#order-notification").modal("show");
                  $("#order-notification-body").html(
                    "Ngày giao hàng phải lớn hơn ngày đặt hàng"
                  );
                  setTimeout(() => {
                    $("#order-notification").modal("hide");
                  }, 1500);
                  check = false;
                }
              }
            } else if (action === 4) {
              dataSend.push($("#order-note").val());
              let note = $("#order-note").val();
              if (note.length === 0) {
                $("#order-notification").modal("show");
                $("#order-notification-body").html(
                  "Vui lòng nhập lý do hủy hàng"
                );
                setTimeout(() => {
                  $("#order-notification").modal("hide");
                }, 1500);
                check = false;
              }
            }
            if (check) {
              $.ajax({
                type: "post",
                url:
                  "/project-shopping-website/admin/modules/orders/verify-order.php",
                data: { id_order, action, dataSend },
                success: function (data) {
                  let noti = JSON.parse(data);
                  if (noti["noti_code"] != 0) {
                    $("#order-notification").modal("show");
                    $("#order-notification-body").html(noti["message"]);
                    setTimeout(() => {
                      $("#order-notification").modal("hide");
                      location.reload();
                    }, 1500);
                  }
                },
              });
            }
          }
        });
      },
    });
  });
  $("#order-complete").on("shown.bs.modal", function (e) {
    let id_order = $(e.relatedTarget).data("id");
    $.ajax({
      type: "post",
      url: "/project-shopping-website/admin/modules/orders/getOrderDetail.php",
      data: { id_order },
      success: function (data) {
        $("#order-complete-body").html(data);
        $("#handle-order").remove();
        $("#btn-complete").on("click", function (e) {
          $.ajax({
            type: "post",
            url:
              "/project-shopping-website/admin/modules/orders/complete-order.php",
            data: { id_order },
            success: function (data) {
              if (noti["noti_code"] != 0) {
                $("#order-notification").modal("show");
                $("#order-notification-body").html(noti["message"]);
                setTimeout(() => {
                  $("#order-notification").modal("hide");
                  location.reload();
                }, 1500);
              }
            },
          });
        });
      },
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
    let status = Number.parseInt($(this).val());
    $.ajax({
      type: "post",
      url:
        "/project-shopping-website/admin/modules/orders/load-order-by-status.php",
      data: { status },
      success: function (data) {
        $("#table-order-body").html(data);
      },
    });
  });
  $("#btn-find-order").on("click", function (e) {
    let id_order = Number.parseInt($("#id-order").val());
    if (id_order === NaN) {
      $("#order-notification").modal("show");
      $("#order-notification-body").html("Vui lòng nhập mã đơn hàng");
    } else {
      $.ajax({
        type: "post",
        url: "/project-shopping-website/admin/modules/orders/find-order.php",
        data: { id_order },
        success: function (data) {
          if (data === null) {
            $("#order-notification").modal("show");
            $("#order-notification-body").html("Không tìm thấy đơn hàng");
          }else{
            $("#table-order-body").html(data);
          }
        },
      });
    }
  });
});
