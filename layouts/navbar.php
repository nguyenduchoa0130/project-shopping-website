<?php
require_once __DIR__ . "/../autoload/autoload.php";
$currentUser = $database->getCurrentUser();
?>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-primary">
    <a class="navbar-brand text-white h5 m-0 mx-2" href="<?php echo ROOT . "/index.php"; ?>"><span class="mr-3"><i class="fas fa-home"></i></span>Trang Chủ</a>
    <button class="navbar-toggler text-white font-weight-bold" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        ☰
    </button>
    <form class="form-inline my-2 my-lg-0" id="formFindProduct" method="get" action="<?php echo ROOT . "/modules/find/index.php"; ?>">
        <input class="form-control mr-sm-2" type="search" name="key" placeholder="Tìm kiếm sản phẩm....." aria-label="Search" size="50">
        <button class="btn btn-outline-info my-2 my-sm-0 text-white" type="submit"><span><i class="fas fa-search"></i></span>
        </button>
    </form>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ml-3">
                <a class="nav-link h5 m-0 text-white" href="<?php echo ROOT . "/modules/order/index.php"; ?>"><span class="mr-3"><i class="fas fa-parachute-box"></i></span>Đơn Hàng</a>
            </li>
            <li class="nav-item ml-3">
                <a class="nav-link h5 m-0 text-white" href="<?php echo ROOT . "/modules/cart/index.php"; ?>"><span class="mr-3"><i class="fas fa-shopping-cart"></i></span>Giỏ Hàng</a>
            </li>
            <li class="nav-item ml-3">
                <a class="nav-link h5 m-0 text-white" href="<?php echo ROOT . "/modules/like/index.php"; ?>"><span class="mr-3"><i class="fas fa-heart"></i></span>Yêu Thích</a>
            </li>
            <?php if ($currentUser) : ?>
                <li class="nav-item ml-3">
                    <a class="nav-link h5 m-0 text-white" href="/project-shopping-website/modules/account/index.php"><span class="mr-3"><i class="fas fa-user-circle"></i></span><?php echo $currentUser["fullname"] ?></a>
                </li>
                <?php if ($currentUser["role"] == "0") : ?>
                    <li class="nav-item ml-3">
                        <a class="nav-link h5 m-0 text-white" href="<?php echo ROOT . "/admin/index.php"; ?>"><span class="mr-3"><i class="fas fa-tools"></i></span> Admin</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item ml-3">
                    <a class="nav-link h5 m-0 text-white" href="/project-shopping-website/modules/account/logout.php"><span class="mr-3"><i class="fas fa-sign-out-alt"></i></span>Đăng Xuất</a>
                </li>
            <?php else : ?>
                <li class="nav-item ml-3">
                    <a class="nav-link h5 m-0 text-white" href="/project-shopping-website/modules/account/login.php"><span class="mr-3"><i class="fas fa-sign-in-alt"></i></span>Đăng Nhập</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="modal" id="navbar-notification-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            <div class="modal-body" id="navbar-body-content">
                <p class="h4 text-info"> Bạn chưa đăng nhập, đăng nhập để thực hiện thao tác</p>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <a type="button" class="btn btn-primary" href="<?php echo ROOT . "/modules/account/login.php"; ?>">Đăng Nhập</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>