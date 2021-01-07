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
            data: { id_user: user["id_user"], id_product: id_product, quantity: quantity},
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

  $(".btn-number").click(function (e) {
    e.preventDefault();

    fieldName = $(this).attr("data-field");
    type = $(this).attr("data-type");
    var input = $("input[name='" + fieldName + "']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
      if (type == "minus") {
        if (currentVal > input.attr("min")) {
          input.val(currentVal - 1).change();
        }
        if (parseInt(input.val()) == input.attr("min")) {
          $(this).attr("disabled", true);
        }
      } else if (type == "plus") {
        if (currentVal < input.attr("max")) {
          input.val(currentVal + 1).change();
        }
        if (parseInt(input.val()) == input.attr("max")) {
          $(this).attr("disabled", true);
        }
      }
    } else {
      input.val(0);
    }
  });
  $(".input-number").focusin(function () {
    $(this).data("oldValue", $(this).val());
  });
  $(".input-number").change(function () {
    minValue = parseInt($(this).attr("min"));
    maxValue = parseInt($(this).attr("max"));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr("name");
    if (valueCurrent >= minValue) {
      $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr(
        "disabled"
      );
    } else {
      alert("Sorry, the minimum value was reached");
      $(this).val($(this).data("oldValue"));
    }
    if (valueCurrent <= maxValue) {
      $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr(
        "disabled"
      );
    } else {
      alert("Sorry, the maximum value was reached");
      $(this).val($(this).data("oldValue"));
    }
  });
  $(".input-number").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if (
      $.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
      // Allow: Ctrl+A
      (e.keyCode == 65 && e.ctrlKey === true) ||
      // Allow: home, end, left, right
      (e.keyCode >= 35 && e.keyCode <= 39)
    ) {
      // let it happen, don't do anything
      return;
    }
    // Ensure that it is a number and stop the keypress
    if (
      (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) &&
      (e.keyCode < 96 || e.keyCode > 105)
    ) {
      e.preventDefault();
    }
  });
});
