<?php
require_once __DIR__ . "/../../../autoload/autoload.php";
?>
<?php
require_once __DIR__ . "/../../layouts/header.php";
?>
<!-- TODO Nội dung trang -->
<div class="container-fluid">

    <?php
    if ($_GET["id_product"] && $_GET["name_category"]) {
        $id_product = $_GET["id_product"];
        $name_category = $_GET["name_category"];
        $data_product = $database->fetchDataById("tbl_product", "id_product", $id_product);
        $product = new Product($data_product[0]);
    } else {
        $product = null;
    }
    ?>

    <?php if ($product) : ?>
        <?php
        $data_img = $database->fetchDataById("tbl_product_img", "id_product", $id_product);
        if ($data_img) {
            $imgs = array();
            foreach ($data_img as $img) {
                array_push($imgs, new ImageProduct($img));
            }
        } else {
            $imgs = null;
        }
        ?>
        <!-- Page Heading -->
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <a class="h3 mb-0 text-gray-800 font-weight-bold text-decoration-none" href="javascript:history.back()">
                    <span><i class="fas fa-shopping-bag"></i></span> Chi Tiết Sản Phẩm |
                </a>
                <span class="h3 mb-0 ml-2 text-gray-800 font-weight-bold"><?php echo $product->get_NameProduct(); ?></span>
            </div>
        </div>

        <hr class="my-2">

        <!-- Information Product -->
        <div class="row">

            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                <?php if ($imgs) : ?>
                    <div class="card border-primary">
                        <img id="img-product-main" class="card-img-top" src="<?php echo $imgs[0]->get_Link(); ?>" alt="Image Product">
                        <hr class="my-2 bg-primary">
                        <div class="card-body m-2 d-flex justify-content-center">
                            <?php foreach ($imgs as $img) : ?>
                                <a class="d-inline text-decoration-none btn-change-product-image">
                                    <img class="w-75 img-thumbnail" src="<?php echo $img->get_Link(); ?>" alt="Image Product">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="alert alert-warning" role="alert">
                        Có lỗi đã xảy ra !!!
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                <div id="product-information" class="container-fluid border rounded border-info">
                    <div class="container-fluid text-center">
                        <p class="h3 mb-0 text-gray-800 font-weight-bold"> Thông Tin Sản Phẩm</p>
                    </div>
                    <hr class="my-3 bg-info">
                    <div class="container-fluid">
                        <?php echo createFormProductDetail($product->get_IdProduct(), $name_category, $product, $imgs); ?>
                    </div>
                </div>
            </div>

        </div>

        <hr class="my-3">

        <!-- Review Product -->
        <div class="row">

        </div>

    <?php else : ?>
        <div class="alert alert-warning" role="alert">
            Có lỗi đã xảy ra !!!
        </div>
    <?php endif ?>

    <!-- Content Row Xác Nhận Xóa-->
    <div class="modal fade" id="product-verifyDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header bg-info">
                    <h4 class="modal-title w-100 text-white font-weight-bold" id="myModalLabel"><span><i class="fas fa-exclamation-triangle"></i></span> Cánh Báo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <h4 class="modal-title w-100 text-danger" id="myModalLabel">Bạn có thật sự muốn xóa sản phẩm này ?</h4>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" id="btn-delete-product" class="btn btn-danger">Xóa</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Hủy</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>

    <div class="modal fade" id="product-notification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header bg-info">
                    <h4 class="modal-title w-100 text-white font-weight-bold" id="myModalLabel"><span><i class="fas fa-exclamation-triangle"></i></span> Cánh Báo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body product-notifi-content">

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