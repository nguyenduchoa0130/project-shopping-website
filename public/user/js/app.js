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
    let task = $(this).data("task");
    let page = ($(this).data("page") - 1) * 3;
    $.ajax({
      type: "post",
      url: "/project-shopping-website/lib/pagination.php",
      data: { task, page },
      success: function (data) {
        if (task === "sellest") {
          $("#list-10-product-sellest").html(data);
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
});
