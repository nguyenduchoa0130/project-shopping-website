<?php
require_once __DIR__ . "/../../../autoload/autoload.php";
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
        $data_img = $database->fetchDataById("tbl_image_product", "id_product", $id_product);
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
                    <div class="card border-primary p-2">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <img id="img-product-main" class="card-img-top h-100" src="<?php echo "data:image;base64, {$imgs[0]->image}"; ?>" alt="Image Product">
                            </div>
                        </div>

                        <hr class="my-2 bg-primary">

                        <div class="card-body m-2 d-flex justify-content-center">
                            <div class="row">
                                <?php foreach ($imgs as $img) : ?>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 my-2">
                                        <a class="d-inline text-decoration-none btn-change-product-image">
                                            <?php
                                            echo "<img class='px-2 w-100 h-100' src='data:image;base64,{$img->image}' alt='Image Product'>";
                                            ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="alert alert-warning" role="alert">
                        Không có hình ảnh
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                <div id="product-information" class="container-fluid border rounded border-info py-2">
                    <div class="container-fluid text-center">
                        <p class="h3 mb-0 text-gray-800 font-weight-bold"> Thông Tin Sản Phẩm</p>
                    </div>
                    <hr class="my-3 bg-info">
                    <div class="container-fluid">
                        <?php echo createFormProductDetail($product->get_IdCategory(), $name_category, $product, $imgs); ?>
                    </div>
                </div>
            </div>

        </div>

        <hr class="my-3">

        <!-- Review Product -->
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <p class="h3 mb-0 text-gray-800 font-weight-bold text-decoration-none">
                    <span><i class="fas fa-comments"></i></span> Bình Luận
                </p>
            </div>
            <hr class="my-2">
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
                    <h4 class="modal-title w-100 text-danger" id="myModalLabel">Bạn có thật sự muốn xóa sản phẩm này ?
                    </h4>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" id="btn-delete-product" data-id="<?php echo $id_product; ?>" class="btn btn-danger">Xóa</button>
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
                <div class="modal-body" id="product-notification-content">

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