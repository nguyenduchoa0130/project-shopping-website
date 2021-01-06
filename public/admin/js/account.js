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
  $("#account-change-role").on("shown.bs.modal", function(e){
    let username =  $(e.relatedTarget).data("username");
    let code = {
      getRole: 1,
      changeRole: 2
    }
    // Lấy quyền của vai trò của tài khoản
    $.ajax({
      type: "post",
      url: "/project-shopping-website/admin/modules/accounts/change-role.php",
      data: {username, code: code.getRole},
      success: function (data) {
        $("#inputGroupSelect01").html(data);
        $("#btn-change-role").on("click", function(event){
         let role = $("#inputGroupSelect01").val();
          $.ajax({
            type: "post",
            url: "/project-shopping-website/admin/modules/accounts/change-role.php",
            data: {username, code: code.changeRole, role: role},
            success: function (data) {
              $("#account-change-role-body").html(data);
              setTimeout(()=>{
                $("#account-change-role").modal("hide");
                location.reload();
              }, 1000);
            }
          });
        });
      }
    });
  });
});
