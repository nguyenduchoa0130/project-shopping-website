<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/user/css/register-style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card card-signin flex-row my-5" id="register-content">
                    <div class="card-img-left d-none d-md-flex">
                    </div>
                    <div class="card-body" id="register-body">
                        <h5 class="card-title text-center text-primary font-weight-bold"><span><i class="fas fa-user-plus"></i></span> Đăng Ký Tài Khoản</h5>
                        <form class="form-signin" action="" method="post" id="register-form-register">
                            <div class="form-label-group">
                                <input type="text" id="username" name="username" class="form-control" placeholder="Tên đăng nhập..." required autofocus>
                                <label for="username">Tên Đăng Nhập</label>
                            </div>

                            <div class="form-label-group">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Địa chỉ email.." required>
                                <label for="email">Địa Chỉ Email</label>
                            </div>

                            <hr>

                            <div class="form-label-group">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                                <label for="password">Mật Khẩu</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="Password" required>
                                <label for="confirm-password">Nhập Lại Mật Khẩu</label>
                            </div>
                            <div class="my-3 px-3" id="register-notification">

                            </div>
                            <div class="form-label-group">
                                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit"><span><i class="fas fa-user-plus"></i></span> Đăng Ký</button>
                            </div>
                        </form>
                        <hr class="my-4">
                        <a class="btn-additional btn btn-lg btn-google btn-block text-uppercase" href="login.php"><span><i class="fas fa-sign-in-alt"></i></span> Đăng Nhập</a>
                        <a class="btn-additional btn btn-lg btn-success btn-block text-uppercase" href="../../index.php"><span><i class="fas fa-arrow-left"></i></span> Trở về trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/dcb76ae865.js" crossorigin="anonymous"></script>
    <script src="/project-shopping-website/public/user/js/account.js"></script>

</body>

</html>