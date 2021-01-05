$(document).ready(function (e) {
  $("#register-form-register").on("submit", function (event) {
    event.preventDefault();
    let values = $("#register-form-register").serialize();
    let dataForm = null;
    $.ajax({
      type: "post",
      url: "/project-shopping-website/modules/account/register-handle.php",
      contentType: "application/x-www-form-urlencoded;charset=UTF-8",
      data: {
        values,
      },
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
              data: {
                values_otp,
              },
              success: function (data) {
                let noti = JSON.parse(data);
                if (noti["noti_code"] === 0) {
                  $("#register-notification").html(noti["message"]);
                } else if (noti["noti_code"] === 1) {
                  $.ajax({
                    type: "post",
                    url:
                      "/project-shopping-website/modules/account/register-handle.php",
                    contentType:
                      "application/x-www-form-urlencoded;charset=UTF-8",
                    data: {
                      dataForm,
                    },
                    success: function (data) {
                      $("#register-content").html(data);
                      $("#register-form-complete-profile").on(
                        "submit",
                        function (event) {
                          event.preventDefault();
                          let completeData = $(
                            "#register-form-complete-profile"
                          ).serialize();
                          $.ajax({
                            type: "post",
                            url:
                              "/project-shopping-website/modules/account/register-handle.php",
                            contentType:
                              "application/x-www-form-urlencoded;charset=UTF-8",
                            data: {
                              completeData,
                            },
                            success: function (data) {
                              let noti = JSON.parse(data);
                              if (noti["noti_code"] === 0) {
                                $("#register-notification").html(
                                  noti["messsage"]
                                );
                              } else if (noti["noti_code"] === 1) {
                                $("#register-notification-modal").modal("show");
                                setTimeout(() => {
                                  $("#register-notification-modal").modal(
                                    "hide"
                                  );
                                  location.href = "../../index.php";
                                }, 1000);
                              } else {
                                alert(
                                  "Có lỗi nghiêm trọng đã xảy ra với hệ thống !!!"
                                );
                              }
                            },
                          });
                        }
                      );
                    },
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

  $("#login-form-login").on("submit", function (event) {
    event.preventDefault();
    let infoAccount = $("#login-form-login").serialize();
    $.ajax({
      type: "post",
      url: "/project-shopping-website/modules/account/login-handle.php",
      contentType: "application/x-www-form-urlencoded;charset=UTF-8",
      data: {
        infoAccount,
      },
      success: function (data) {
        let noti = JSON.parse(data);
        if (noti["noti_code"] === 0) {
          $("#login-notification").html(noti["message"]);
        } else if (noti["noti_code"] === 1) {
          setTimeout(() => {
            location.href = "../../index.php";
          }, 1000);
        } else {
          alert("Có lỗi nghiêm trọng đã xảy ra");
        }
      },
    });
  });

  $("#forget-pasword-form-find-account").on("submit", function (event) {
    event.preventDefault();
    let dataForm = $("#forget-pasword-form-find-account").serialize();
    let completeForm = null;
    $.ajax({
      type: "post",
      url:
        "/project-shopping-website/modules/account/forget-password-handle.php",
      data: { dataForm },
      success: function (data) {
        let noti = JSON.parse(data);
        if (noti["noti_code"] === 0) {
          $("#forget-password-notification").html(noti["message"]);
        } else if (noti["noti_code"] === 1) {
          $("#forget-password-body").html(noti["message"]);
          $("#register-form-verify-otp").on("submit", function (event) {
            event.preventDefault();
            let values_otp = $("#register-form-verify-otp").serialize();
            $.ajax({
              type: "post",
              url: "/project-shopping-website/modules/account/verify-otp.php",
              contentType: "application/x-www-form-urlencoded;charset=UTF-8",
              data: {
                values_otp,
              },
              success: function (data) {
                $("#forget-password-loading").modal("hide");
                let noti = JSON.parse(data);
                if (noti["noti_code"] === 0) {
                  $("#register-notification").html(noti["message"]);
                } else if (noti["noti_code"] === 1) {
                  completeForm = values_otp;
                  $.ajax({
                    type: "post",
                    url:
                      "/project-shopping-website/modules/account/forget-password-handle.php",
                    data: { completeForm },
                    success: function (data) {
                      $("#forget-password-content").html(data);
                      $("#forget-password-form-complete-password").on(
                        "submit",
                        function (event) {
                          event.preventDefault();
                          let newPassword = $(
                            "#forget-password-form-complete-password"
                          ).serialize();
                          $.ajax({
                            type: "post",
                            url:
                              "/project-shopping-website/modules/account/forget-password-handle.php",
                            data: { newPassword },
                            success: function (data) {
                              let noti = JSON.parse(data);
                              if (noti["noti_code"] === 0) {
                                $("#forget-password-notification").html(
                                  noti["message"]
                                );
                              } else if (noti["noti_code"] === 1) {
                                $("#forget-password-notification-modal").modal(
                                  "show"
                                );
                                setTimeout(() => {
                                  location.href = "../../index.php";
                                }, 1000);
                              }
                            },
                          });
                        }
                      );
                    },
                  });
                } else {
                  alert("Có lỗi nghiêm trọng đã xảy ra với hệ thống");
                }
              },
            });
          });
        }
      },
    });
  });
});
