$(document).ready(function () {
  $("#infoProduct").on("show.bs.modal", function (e) {
    var id1 = $(e.relatedTarget).data("id");
    var id2 = $(e.relatedTarget).data("idcategory");
    var category = $(e.relatedTarget).data("ncategory");
    $.ajax({
      type: "post",
      url:
        "/project-shopping-website-beta/admin/modules/category/load-info-product.php", //Here you will fetch records
      data: { id_product: id1, id_category: id2, name_category: category },
      success: function (data) {
        $(".modal-body-info").html(data);

        $("#formUpdateProduct").on("submit", function (event) {
          event.preventDefault();
          let values = $("#formUpdateProduct").serialize();
          $.ajax({
            type: "post",
            url:
              "/project-shopping-website-beta/admin/modules/category/update-product.php",
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            data: { values, id_product: id1 },
            success: function (data) {
              $("#showNotification").modal("show");
              $(".content-notifation").html(data);
              setTimeout(function () {
                $("#showNotification").modal("hide");
                location.reload();
              }, 1000);
            },
          });
        });

        $("#verifyDelete").on("show.bs.modal", function (event) {
          $("#btn-delete-product").on("click", function (event) {
            $.ajax({
              type: "post",
              url:
                "/project-shopping-website-beta/admin/modules/category/remove-product.php",
              contentType: "application/x-www-form-urlencoded;charset=UTF-8",
              data: { id_product: id1 },
              success: function (data) {
                $("#showNotification").modal("show");
                $(".content-notifation").html(data);
                setTimeout(function () {
                  $("#showNotification").modal("hide");
                  location.reload();
                }, 1000);
              },
            });
          });
        });
      },
    });
  });
  
  $("#formAddProduct").on("submit", function (event) {
    event.preventDefault();
    let values = $("#formAddProduct").serialize();
    $.ajax({
      type: "post",
      url:
        "/project-shopping-website-beta/admin/modules/category/add-product.php",
      contentType: "application/x-www-form-urlencoded;charset=UTF-8",
      data: { values },
      success: function (data) {
        $("#showNotification").modal("show");
        $(".content-notifation").html(data);
        setTimeout(function () {
          $("#showNotification").modal("hide");
          location.reload();
        }, 1000);
      },
    });
  });
});
