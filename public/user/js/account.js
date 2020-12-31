$(document).ready(function (e) {
  $("#register-form-register").on("submit", function (event) {
    event.preventDefault();
    let values = $("#register-form-register").serialize();
    let dataForm = null;
    $.ajax({
      type: "post",
      url: "/project-shopping-website/modules/account/register-handle.php",
      contentType: "application/x-www-form-urlencoded;charset=UTF-8",
      data: { values },
      success: function (data) {
        let noti = JSON.parse(data);
        if (noti["noti_code"] === 0) {
          $("#register-notification").html(noti["message"]);
        } else if (noti["noti_code"] === 1) {
          $("#register-body").html(noti["message"]);
          dataForm = values;
          $("#register-form-verify-otp").on("submit", function (event) {
            event.preventDefault();
            let values_otp = $("#register-form-verify-otp").serialize();
            $.ajax({
              type: "post",
              url: "/project-shopping-website/modules/account/verify-otp.php",
              contentType: "application/x-www-form-urlencoded;charset=UTF-8",
              data: { values_otp },
              success: function (data) {
                let noti = JSON.parse(data);
                if (noti["noti_code"] === 0) {
                  $("#register-notification").html(noti["message"]);
                } else if (noti["noti_code"] === 1) {
                    $.ajax({
                        type: "post", 
                        url: "/project-shopping-website/modules/account/register-handle.php",
                        contentType: "application/x-www-form-urlencoded;charset=UTF-8",
                        data: {dataForm},
                        success: function(data){
                          $("#register-content").html(data);
                          $("#register-form-complete-profile").on("submit", function(event){
                              let completeData = $("#register-form-complete-profile").serialize();
                              $.ajax({
                                type: "post", 
                                url: "/project-shopping-website/modules/account/register-handle.php",
                                contentType: "application/x-www-form-urlencoded;charset=UTF-8",
                                data: {completeData},
                                success: function(data){
                                  alert(data);
                                }    
                              });
                          });
                        }
                    });
                } else {
                  alert("Có lỗi nghiêm trọng đã xảy ra với hệ thống");
                }
              },
            });
          });
        } else {
          alert("Có lỗi nghiêm trọng đã xảy ra với hệ thống");
        }
      },
    });
  });
});
