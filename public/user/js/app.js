window.page;
$(document).ready(function (event) {
  $(".task-require-login").on("click", function (e) {
    let req = "currentUser";
    $.ajax({
      type: "post",
      url: "/project-shopping-website/modules/account/getSession.php",
      data: { req },
      success: function (data) {
        if (data !== "") {
          let user = JSON.parse(data); // lấy ra được đối tượng người dùng
        } else {
          $("#navbar-notification-modal").modal("show");
        }
      },
    });
  });
  $(".page-link").on("click", function (e) {
    if(window.page){
      $(window.page).removeClass("active");
    }
    $(this).addClass("active");
    if(!($(window.page).hasClass("previous") || $(window.page).hasClass("after"))){
      window.page = $(this);
      console.log(window.page);
    }
    let task = $(this).data("task");
    let page = ($(this).data("page") - 1) * 3;
    $.ajax({
      type: "post",
      url: "/project-shopping-website/lib/pagination.php",
      data: { task, page },
      success: function (data) {
        if (task === "sellest") {
          // $("#list-10-product-sellest").html(data);
        }
        if (task === "likest") {
          $("#list-10-product-likest").html(data);
        }
        if (task === "new") {
          $("#list-10-product-new").html(data);
        }
        if(task === "productLike"){
          $("#list-product-like").html(data);
        }
      },
    });
  });
  $(".previous").on("click", function(e){
    alert("previous");
  })
  $(".next").on("click", function(e){
    alert("after");
  })

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
