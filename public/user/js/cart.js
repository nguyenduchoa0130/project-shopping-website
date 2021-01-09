$(document).ready(function () {
  $(".select-product").on("change", function (e) {
    if ($(this).prop("checked")) {
      let count = $("#order-detail-body tr").length;
      let card = $(this).closest(".card-product-cart");
      let card_body = $(card).find(".card-body");
      let name = $(card_body).find(".name").html().trim();
      let price = Number.parseInt($(card_body).find(".price").html().slice(4));
      let quantity = $(card_body).find(".quantity").val();
      let id_product = Number.parseInt($(card).find("input[id]").attr("id"));
      let row = `
        <tr>
            <th scope="row" class='text-center h6' id='${id_product}'>${
        count + 1
      }  </th>
            <td class='text-center h6'>${name}</td>
            <td class='text-center'>${quantity}</td>
            <td class='text-center'>${price}</td>
            <td class='text-center'>${price * quantity}</td>
      </tr>`;
      $("#order-detail-body").append(row);
      let price_ship =
        Number.parseInt($("#price-ship").html()) + 10000 * quantity;
      let temp_cash =
        Number.parseInt($("#temp-cash").html()) + price * quantity;
      let sum_cash = price_ship + temp_cash;
      $("#price-ship").html(`${price_ship}`);
      $("#temp-cash").html(`${temp_cash}`);
      $("#sum-cash").html(`${sum_cash}`);
    } else {
      // lấy id của sản phẩm cần xóa
      let card = $(this).closest(".card-product-cart");
      let card_body = $(card).find(".card-body");
      let price = Number.parseInt($(card_body).find(".price").html().slice(4));
      let quantity = $(card_body).find(".quantity").val();
      let id_product = Number.parseInt($(card).find("input[id]").attr("id"));
      // Lấy các dòng trong bảng đó ra
      let rows = $("#order-detail-body").find("tr");
      let rowRemove = null;
      for (const tr of rows) {
        if (rowRemove) {
          tr.children[0].innerHTML =
            Number.parseInt(tr.children[0].innerHTML) - 1;
        } else {
          let id = Number.parseInt($(tr).find("th[id]").attr("id"));
          if (id === id_product) {
            rowRemove = tr;
            let price_ship =
              Number.parseInt($("#price-ship").html()) - 10000 * quantity;
            let temp_cash =
              Number.parseInt($("#temp-cash").html()) - price * quantity;
            let sum_cash =
              Number.parseInt($("#sum-cash").html()) -
              (10000 * quantity + price * quantity);
            $("#price-ship").html(`${price_ship}`);
            $("#temp-cash").html(`${temp_cash}`);
            $("#sum-cash").html(`${sum_cash}`);
          }
        }
      }
      $(rowRemove).remove();
    }
  });

  $("#btn-pay").on("click", function (e) {
    let orderDetailData = [];

    let rows = $("#order-detail-body").children();
    if (rows.length) {
      for (const row of rows) {
        let data = $(row).children();
        let order_detail = {};
        order_detail.id_product = Number.parseInt($(data[0]).attr("id"));
        order_detail.quantity = Number.parseInt($(data[2]).html());
        order_detail.price = Number.parseInt($(data[3]).html());
        order_detail.sum_price = Number.parseInt($(data[4]).html());
        orderDetailData.push(order_detail);
      }
      let req = "currentUser";
      $.ajax({
        type: "post",
        url: "/project-shopping-website/modules/account/getSession.php",
        data: { req },
        success: function (data) {
          let price_ship = Number.parseInt($("#price-ship").html());
          let sum_cash = Number.parseInt($("#sum-cash").html());
          let noti = JSON.parse(data);
          if (noti !== null) {
            $.ajax({
              type: "post",
              url: "/project-shopping-website/modules/order/add-order.php",
              data: {
                id_user: noti["id_user"],
                address_ship: noti["address"],
                data: JSON.stringify(orderDetailData),
                ship_cash: price_ship,
                sum_cash: sum_cash,
              },
              success: function (data) {
                let noti = JSON.parse(data);
                if (noti["noti_code"] !== 0) {
                  $("#cart-notification").modal("show");
                  $("#cart-notification-body").html(noti["message"]);
                  setTimeout(() => {
                    $("#cart-notification").modal("hide");
                    location.reload();
                  }, 500);
                }
              },
            });
          }
        },
      });
    } else {
      $("#cart-notification").modal("show");
      $("#cart-notification-body").html(
        "<p class='h4 m-0 text-danger'>Vui lòng chọn sản phẩm</p>"
      );
      setTimeout(() => {
        $("#cart-notification").modal("hide");
      }, 1000);
    }
  });

  $(".btn-remove-product-cart").on("click", function (e) {
    let card = $(this).closest(".card-product-cart");
    let id_cart = Number.parseInt($(card).attr("id"));
    let card_body = $(card).find(".card-body");
    let price = Number.parseInt($(card_body).find(".price").html().slice(4));
    let quantity = $(card_body).find(".quantity").val();
    let id_product = Number.parseInt($(card).find("input[id]").attr("id"));
    // Lấy các dòng trong bảng đó ra
    let rows = $("#order-detail-body").find("tr");
    let rowRemove = null;
    for (const tr of rows) {
      if (rowRemove) {
        tr.children[0].innerHTML =
          Number.parseInt(tr.children[0].innerHTML) - 1;
      } else {
        let id = Number.parseInt($(tr).find("th[id]").attr("id"));
        if (id === id_product) {
          rowRemove = tr;
          let price_ship =
            Number.parseInt($("#price-ship").html()) - 10000 * quantity;
          let temp_cash =
            Number.parseInt($("#temp-cash").html()) - price * quantity;
          let sum_cash =
            Number.parseInt($("#sum-cash").html()) -
            (10000 * quantity + price * quantity);
          $("#price-ship").html(`${price_ship}`);
          $("#temp-cash").html(`${temp_cash}`);
          $("#sum-cash").html(`${sum_cash}`);
          $(card).remove();
        }
      }
    }
    $(rowRemove).remove();
    $.ajax({
      type: "post",
      url: "/project-shopping-website/modules/cart/remove.php",
      data: {id_cart, id_product},
      success: function (data) {
       
      }
    });
  });

});
  