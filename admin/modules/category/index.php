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
        <a class="h3 mb-0 text-gray-800 font-weight-bold text-decoration-none" href="javascript:history.back()">
            <span><i class="fas fa-shopping-bag"></i>
            </span> Quản Lý Sản Phẩm
        </a>
        <button type="button" class="btn btn-primary waves-effect waves-light d-inline" data-toggle="modal" data-target="#addCategory">
            <span><i class="fas fa-plus"></i></span>
            Thêm Mới
        </button>
    </div>

    <hr class="my-4">

    <!-- Content Row -->
    <?php
    $categories = $database->fetchDataAll("tbl_category");
    if ($categories != null) {
        foreach ($categories as $category) {
            $item = new Category($category);
            echo "
                    <div class='card m-3 text-success font-weight-bold d-inline-block' style='width: 18rem; '>
                        <div class='container-fluid text-center h1 pt-3 pb-3 border-bottom'>
                            <span><i class='{$item->get_ImgCategory()}'></i></span>
                        </div>
                        <div class='card-body h3'> 
                            <h5 class='card-title text-center font-weight-bold h4'>{$item->get_NameCategory()}</h5>
                            <a href='category-detail.php?id_category={$item->get_IdCategory()}&name={$item->get_NameCategory()}' class='btn btn-success d-block '>Chi Tiết</a>
                            <a href='category-detail.php?id_category={$item->get_IdCategory()}&name={$item->get_NameCategory()}' class='btn btn-google d-block my-2'>Xóa Danh Mục</a>
                        </div>
                    </div>   
                ";
        }
    } else {
        echo "
                <div class='alert alert-warning' role='alert'>
                    Không có sản phẩm nào
                </div> 
            ";
    }
    ?>

    <!-- Content Row -->
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header text-center  bg-primary text-light">
                    <h4 class="font-weight-bold modal-title w-100" id="myModalLabel">Thêm Danh Mục Sản Phẩm</h4>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body p-3">
                    <form action="" method="post" id="formAddCategory" accept-charset="utf-8">
                        <div class="form-group">
                            <label for="name_category">Tên Danh Mục</label>
                            <input class="form-control" id="name_category" name="name_category" type="text" placeholder="Tên Danh Mục Sản Phẩm" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary m-auto">Thêm</button>
                            <button type="button" class="btn btn-danger m-auto" data-dismiss="modal">Đóng</button>
                        </div>
                    </form>
                </div>
                <!--Footer-->
            </div>
            <!--/.Content-->
        </div>
    </div>
    <div class="modal fade" id="showNotification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header bg-info">
                    <h4 class="modal-title w-100 text-white font-weight-bold" id="myModalLabel"><span><i class="fas fa-exclamation-triangle"></i></span> Thông Báo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body content-notifation">

                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>

</div>
<!-- TODO Nội dung trang -->
<?php
require_once __DIR__ . "/../../layouts/footer.php";
?>