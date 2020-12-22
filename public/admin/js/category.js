$(document).ready(function () {
  $("#formAddCategory").on("submit", function (event) {
    event.preventDefault();
    let values = $("#formAddCategory").serialize();
    $.ajax({
      type: "post",
      url:
        "/project-shopping-website-beta/admin/modules/category/add-category.php",
      contentType: "application/x-www-form-urlencoded;charset=UTF-8",
      data: { values },
      success: function (data) {
        $(".content-add-category").html(data);
        setTimeout(function () {
          $("#addCategory").modal("hide");
          location.reload();
        }, 1000);
      },
    });
  });
  $("#showNotificationRemove").on("show.bs.modal", function (e) {
    let id = $(e.relatedTarget).data("idcategory");
    $("#btn-remove-category").on("click", function (e) {
      $.ajax({
        type: "post",
        url:
          "/project-shopping-website-beta/admin/modules/category/remove-category.php",
        data: { id_category: id },
        success: function (data) {
          $(".content-notifation-remove").html(data);
          setTimeout(() => {
            $("#showNotificationRemove").modal("hide");
            location.reload();
          }, 1000);
        },
      });
    });
  });
  $("#updateNameCategory").on("show.bs.modal", function (e) {
    let id_category = $(e.relatedTarget).data("idcategory");
    let name_category = $(e.relatedTarget).data("namecategory");
    $("input#name_category").prop("value", name_category);
    $("#formUpdateNameCategory").on("submit", function (event) {
      event.preventDefault();
      let values = $("#formUpdateNameCategory").serialize();
      $.ajax({
        type: "post",
        url:
          "/project-shopping-website-beta/admin/modules/category/update-category.php",
        contentType: "application/x-www-form-urlencoded;charset=UTF-8",
        data: { values, id_category: id_category },
        success: function (data) {
          $(".content-update-category").html(data);
          setTimeout(function () {
            $("#updateNameCategory").modal("hide");
            location.reload();
          }, 1000);
        },
      });
    });
  });
});
