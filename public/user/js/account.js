$(document).ready(function(e){
    $("#register-form-register").on("submit", function(event){
        event.preventDefault();
        let values = $("#register-form-register").serialize();
        $.ajax({
            type: "post",
            url: "/project-shopping-website/modules/account/register-handle.php",
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            data: {values},
            success: function(data){
                let noti = JSON.parse(data);
                if(noti["noti_code"] === 0){
                    $("#register-notification").html(noti["message"]);
                }else if(noti["noti_code"] === 1){
                    $("#register-body").html(noti["message"]);
                }
            }
          });
    });
    $("#register-form-verify-otp").on("submit", function(event){
        event.preventDefault();
        let values = $("#register-form-verify-otp").serialize();
        $.ajax({
            type: "post",
            url: "/project-shopping-website/modules/account/verify-otp.php",
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            data: {values},
            success: function(data){

            }
          });
    });
});