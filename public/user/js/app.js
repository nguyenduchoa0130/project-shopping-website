$(document).ready(function (event) {
  $(".task-require-login").on("click", function (event) {
    let req = "currentUser";
    $.ajax({
      type: "post",
      url: "/project-shopping-website/modules/account/getSession.php",
      data: { req },
      success: function (data) {
        if(data !== ''){
            let user = JSON.parse(data);// lấy ra được đối tượng người dùng
        }else{
            $("#navbar-notification-modal").modal("show");
        }
      },
    });
  });
});
