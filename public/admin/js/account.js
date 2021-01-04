$(document).ready(function () {
  $("#account-verify-delete").on("shown.bs.modal", function (e) {
    let username = $(e.relatedTarget).data("username");
    $("#account-btn-delete").on("click", function (e) {
      $.ajax({
        type: "post",
        url:
          "/project-shopping-website/admin/modules/accounts/remove-account.php",
        data: { username },
        success: function (data) {
          let noti = JSON.parse(data);
          if(noti["noti_code"] === 0){
            $("#account-notification").modal("show")
            $("#account-notification-body").html("<p class='h4 text-danger font-weight-bold'><i class='fas fa-times'></i> Không thể xóa tài khoản quản trị viên</p>");
            setTimeout(()=>{
                $("#account-notification").modal("hide")
            }, 1000);
          }else{
            $("#account-verify-delete-body").html("<p class='h3 text-success text-center font-weight-bold'><i class='fas fa-envelope'></i> Xóa Thành Công</p>");
            setTimeout(()=>{
                $("#account-verify-delete").modal("hide");
                location.reload();
            }, 1000);
          }
        },
      });
    });
  });
});
