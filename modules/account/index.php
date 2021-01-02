<?php
require_once __DIR__ . "/../../autoload/autoload.php";
$currentUser = $database->getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Cá Nhân</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
    #profile-body{
        background: rgb(238,174,202);
        background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(44,22,189,1) 100%);
    }
    </style>
</head>

<body id="profile-body">
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group font-weight-bold">
                    <a href="javascript:window.location.href=window.location.href"
                        class="list-group-item list-group-item-action active"><span><i class="fas fa-id-card mr-2"></i></span>Thông Tin Cá Nhân</a>
                    <a href="#" class="list-group-item list-group-item-action text-primary"><span><i class="fas fa-archive mr-2"></i></span>Đơn Hàng</a>
                    <a href="#" class="list-group-item list-group-item-action text-primary"><span><i class="fas fa-heart mr-2"></i></i></span>Yêu Thích</a>
                    <a href="#" class="list-group-item list-group-item-action text-primary"><span><i class="fas fa-shopping-cart mr-2"></i></i></span> Giỏ Hàng</a>
                    <a href="#" class="list-group-item list-group-item-action text-success"><span><i class="fas fa-store mr-2"></i></span>Trở lại mua sắm</a>
                    <a href="#" class="list-group-item list-group-item-action text-danger"><span><i class="fas fa-sign-out-alt mr-2"></i></i></span>Đăng Xuất</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center text-primary">
                                <h2>Thông Tin Tài Khoản</h2>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="" id="profile-form">
                                    <div class="form-group row">
                                        <label for="username" class="col-4 col-form-label">Tên đăng nhập</label>
                                        <div class="col-8">
                                            <input id="username" name="username" placeholder="Tên đăng nhập"
                                                class="form-control here" required="required" type="text"
                                                value="<?php echo $currentUser["username"]; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newpass" class="col-4 col-form-label">Mật Khẩu Mới</label>
                                        <div class="col-8">
                                            <input id="newpass" name="newpass" placeholder="Mật khẩu mới"
                                                class="form-control here" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirm-password" class="col-4 col-form-label">Nhập lại mật
                                            khẩu</label>
                                        <div class="col-8">
                                            <input id="confirm-password" name="confirm-password"
                                                placeholder="Nhập lại mật khẩu" class="form-control here"
                                                type="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-4 col-form-label">Email</label>
                                        <div class="col-8">
                                            <input id="email" name="email" placeholder="Email" class="form-control here"
                                                required="required" type="text"
                                                value="<?php echo $currentUser["email"]; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fullname" class="col-4 col-form-label">Họ và tên</label>
                                        <div class="col-8">
                                            <input id="fullname" name="nafullnameme" placeholder="Họ và tên"
                                                class="form-control here" type="text"
                                                value="<?php echo $currentUser["fullname"]; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fullname" class="col-4 col-form-label">Giới Tính</label>
                                        <div class="col-8">
                                            <?php if ($currentUser["gender"] == "Nam"): ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="male"
                                                    value="Nam" checked>
                                                <label class="form-check-label font-weight-bold"
                                                    style="font-size: 18px !important;" for="male">Nam</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="female"
                                                    value="Nữ">
                                                <label class="form-check-label font-weight-bold"
                                                    style="font-size: 18px !important;" for="female">Nữ</label>
                                            </div>
                                            <?php else: ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="male"
                                                    value="Nam">
                                                <label class="form-check-label font-weight-bold"
                                                    style="font-size: 18px !important;" for="male">Nam</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="female"
                                                    value="Nữ" checked>
                                                <label class="form-check-label font-weight-bold"
                                                    style="font-size: 18px !important;" for="female">Nữ</label>
                                            </div>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="birth" class="col-4 col-form-label">Ngày Sinh</label>
                                        <div class="col-8">
                                            <input id="birth" name="birth" placeholder="Ngày Sinh"
                                                class="form-control here" type="text"
                                                value="<?php echo $currentUser["birth"]; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-4 col-form-label">Điện Thoại</label>
                                        <div class="col-8">
                                            <input id="phone" name="phone" placeholder="Điện thoại"
                                                class="form-control here" type="text"
                                                value="<?php echo $currentUser["phone"]; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-4 col-form-label">Địa chỉ</label>
                                        <div class="col-8">
                                            <input id="address" name="address" placeholder="Địa chỉ"
                                                class="form-control here" type="text"
                                                value="<?php echo $currentUser["address"]; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-4 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div id="profile-notification"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-4 col-8">
                                            <button name="submit" type="submit" class="btn btn-primary">
                                            Cập Nhật
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/dcb76ae865.js" crossorigin="anonymous"></script>
</body>

</html>