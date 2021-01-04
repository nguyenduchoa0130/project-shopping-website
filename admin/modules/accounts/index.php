<?php
require_once __DIR__ . "/../../../autoload/autoload.php";
?>
<?php
require_once __DIR__ . "/../../layouts/header.php";
?>
<!-- TODO Nội dung trang -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold"><span><i class="fas fa-users"></i></span> Quản Lý Tài Khoản</h1>
    </div>
    <hr class="my-2">
    <!-- Content Row -->
    <div class="row">
        <div class="card m-2 text-success font-weight-bold d-inline-block" style="width: 18rem; ">
            <div class="container-fluid text-center h1 pt-3 pb-3 border-bottom">
                <span><i class="fas fa-tools"></i></span>
            </div>
            <div class="card-body h3 text-center">
                <h5 class="card-title text-center font-weight-bold h4">Admin</h5>
                <a href="account-detail.php?role=0" class="btn btn-success d-inline-block">
                    <span><i class="fas fa-calendar-week"></i></span>
                </a>
            </div>
        </div>
        <div class="card m-2 text-success font-weight-bold d-inline-block" style="width: 18rem; ">
            <div class="container-fluid text-center h1 pt-3 pb-3 border-bottom">
                <span><i class="fas fa-users"></i></span>
            </div>
            <div class="card-body h3 text-center">
                <h5 class="card-title text-center font-weight-bold h4">Khách Hàng</h5>
                <a href="account-detail.php?role=1&name_role=user" class="btn btn-success d-inline-block">
                    <span><i class="fas fa-calendar-week"></i></span>
                </a>
            </div>
        </div>
    </div>

</div>
<!-- TODO Nội dung trang -->
<?php
require_once __DIR__ . "/../../layouts/footer.php";
?>