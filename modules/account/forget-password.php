<?php
require_once __DIR__ . "/../../autoload/autoload.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/user/css/login-style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-7 mx-auto">
                <div class="card card-signin my-5" id="forget-password-content">
                    <div class="card-body" id="forget-password-body">
                        <h5 class="card-title text-center text-primary font-weight-bold"><span><i class="fas fa-search"></i></span> Quên Mật Khẩu</h5>
                        <form class="form-signin" action="" method="post" id="forget-pasword-form-find-account">
                            <div class="form-label-group">
                                <input type="text" id="username" name="username" class="form-control" placeholder="Tên đăng nhập" required autofocus>
                                <label for="username">Tên đăng nhập</label>
                            </div>

                            <div id="forget-password-notification">

                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase my-3" type="submit"><span><i class="fas fa-search"></i></span> Lấy lại mật khẩu</button>
                        </form>
                        <hr class="my-4">
                        <a class="btn-additional btn btn-lg btn-success btn-block text-uppercase" href="../../index.php"><span><i class="fas fa-arrow-left"></i></span> Trở về trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="forget-password-notification-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">Thông Báo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <p class="h3 text-success text-center font-weight-bold"><i class="fas fa-envelope"></i> Đổi mật khẩu công</p>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <div class="modal fade" id="forget-password-loading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                   
                </div>
                <!--Body-->
                <div class="modal-body">
                    <img src="https://i.ibb.co/wsF3NZv/image.png" alt="Loading">
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/dcb76ae865.js" crossorigin="anonymous"></script>
    <script src="/project-shopping-website/public/user/js/account.js"></script>

</body>

</html>
