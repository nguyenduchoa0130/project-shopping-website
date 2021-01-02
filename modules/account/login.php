<?php
    require_once __DIR__. "/../../autoload/autoload.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/user/css/login-style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-7 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center text-primary font-weight-bold"><span><i class="fas fa-sign-in-alt"></i></span> Đăng Nhập</h5>
                        <form class="form-signin" action="" method="post" id="login-form-login">
                            <div class="form-label-group">
                                <input type="text" id="username" name="username" class="form-control" placeholder="Tên đăng nhập" required autofocus>
                                <label for="username">Tên đăng nhập</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                                <label for="password">Mật khẩu</label>
                            </div>

                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" id="save-password">
                                <label class="custom-control-label" for="save-password">Nhớ mật khẩu</label>
                                <a href="forget-password.php" class="text-primary text-decoration-none float-right h5"><span><i class="fas fa-key"></i></span> Quên mật khẩu</a>
                            </div>
                            <div id="login-notification">

                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase my-3" type="submit"><span><i class="fas fa-sign-in-alt"></i></span> Đăng nhập</button>
                        </form>
                        <hr class="my-4">
                        <a class="btn-additional btn btn-lg btn-google btn-block text-uppercase" href="register.php"><span><i class="fas fa-user-plus"></i></span> Đăng Ký Tài Khoản</a>
                        <a class="btn-additional btn btn-lg btn-success btn-block text-uppercase" href="../../index.php"><span><i class="fas fa-arrow-left"></i></span> Trở về trang chủ</a>
                    </div>  
                </div>
            </div>
        </div>
    </div>  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/dcb76ae865.js" crossorigin="anonymous"></script>
    <script src="/project-shopping-website/public/user/js/account.js"></script>

</body>

</html>