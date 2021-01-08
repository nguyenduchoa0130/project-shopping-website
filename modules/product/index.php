<?php
require_once __DIR__ . "/../../autoload/autoload.php";
require_once __DIR__ . "/../../layouts/header.php";
require_once __DIR__ . "/../../layouts/navbar.php";
if (isset($_GET["id_product"])) {
    $number_order = 1;
    $preview = 1;
    $id_product = $_GET["id_product"];
    try {
        $data = $database->fetchDataById("tbl_product", "id_product", $id_product);
        $product = new Product($data[0]);
        $star = $product->star / 10;
        $star = ($star > 5) ? 5 : $star;
        $imgs = $database->fetchDataById("tbl_image_product", "id_product", $id_product);
    } catch (PDOException $e) {
        echo "Có lỗi khi thao tác với database " . $e->getMessage();
    }
} else {
    $product = null;
}
?>
<?php if ($product) : ?>
    <div class="container-fluid p-2 position-relative">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card card-product my-2 d-flex justify-content-start">
                    <div class="container-fluid">
                        <div class="wrapper row">
                            <div class="preview col-md-6">
                                <div class="preview-pic tab-content">
                                    <?php foreach ($imgs as $item) : ?>
                                        <?php
                                        $item = resizeImage($item, 450, 250);
                                        $img = new ImageProduct($item);
                                        $src = createSrcImage($img->image);
                                        ?>
                                        <?php if ($number_order == 1) : ?>
                                            <div class="tab-pane active border border-primary" id="<?php echo "pic-" . $number_order;
                                                                                                    $number_order++; ?>">
                                                <img class="image-product" src="<?php echo $src; ?>" />
                                            </div>
                                        <?php else : ?>
                                            <div class="tab-pane border border-primary" id="<?php echo "pic-" . $number_order;
                                                                                            $number_order++; ?>">
                                                <img class="image-product" src="<?php echo $src; ?>" />
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <ul class="preview-thumbnail nav nav-tabs d-flex justify-content-center">
                                    <?php foreach ($imgs as $item) : ?>
                                        <?php
                                        $item = resizeImage($item, 150, 150);
                                        $img = new ImageProduct($item);
                                        $src = createSrcImage($img->image);
                                        ?>
                                        <?php if ($preview == 1) : ?>
                                            <li class="active border border-primary"><a data-target="<?php echo "#pic-" . $preview;
                                                                                                        $preview++; ?>" data-toggle="tab"><img class="image-product" src="<?php echo $src; ?>" /></a></li>
                                        <?php else : ?>
                                            <li class="border border-primary"><a data-target="<?php echo "#pic-" . $preview;
                                                                                                $preview++; ?>" data-toggle="tab"><img class="image-product" src="<?php echo $src; ?>" /></a></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="details col-md-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td colspan="2">
                                                <h3 class="product-title text-primary text-center m-0"><?php echo $product->name_product ?></h3>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="rating m-0">
                                                    <div class="stars">
                                                        <?php for ($i = 0; $i < (int)$star; $i++) : ?>
                                                            <span class="fa fa-star text-warning h3 m-0"></span>
                                                        <?php endfor; ?>
                                                        <?php for ($i = 0; $i < (int)(5 - $star); $i++) : ?>
                                                            <span class="fa fa-star text-muted h3 m-0"></span>
                                                        <?php endfor; ?>
                                                        <span class="star-no text-warning font-weight-bold h3"><?php echo "(" . $star . ")"; ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="product-produced-at h5 m-0"><span class="text-primary font-weight-bold">Xuất xứ: </span><?php echo $product->produced_at; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="product-description m-0 font-italic"><span class="text-primary font-weight-bold">Mô tả: </span><?php echo $product->description; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="product-quantity h5 text-danger font-italic m-0"><span class="text-primary font-italic">Số lượng còn lại: </span><?php echo $product->quantity; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4 class="price text-danger m-0"><span class="text-danger">Giá: </span><span><?php echo $product->price; ?></span></h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="container p-0 position-relative">
                                    <div class="container m-0">
                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 p-0">
                                                <p class="text-primary font-italic h5 mx-1">Số Lượng: </p>
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <button type="button" class="btn btn-outline-danger btn-number" disabled="disabled" data-type="minus" data-field="quantity">
                                                            <span class="fa fa-minus"></span>
                                                        </button>
                                                    </span>
                                                    <input type="text" id="quantity" name="quantity" class="form-control input-number text-center font-weight-bold" value="1" min="1" max="<?php echo $product->quantity; ?>">
                                                    <span class="input-group-append">
                                                        <button type="button" class="btn btn-outline-success btn-number" data-type="plus" data-field="quantity">
                                                            <span class="fa fa-plus"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row my-4">
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 my-2">
                                                <button type="button" class="btn btn-success w-100 py-2 task-require-login" id="btn-add-to-cart" data-id="<?php echo $id_product; ?>">
                                                    <span class="h4 m-0 mr-2"><i class="fas fa-cash-register"></i></span>
                                                    <span class="h4 m-0">Chọn Mua</span>
                                                </button>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 my-2">
                                                <button type="button" id="btn-like" class="btn btn-danger w-100 py-2 task-require-login" data-id="<?php echo $id_product; ?>">
                                                    <span class="h4 m-0 mr-2"><i class="fas fa-heart"></i></span>
                                                    <span class="h4 m-0">Yêu Thích</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="toast" id="toast-notification" style="position: absolute; top:-10%; right: 0;" data-delay="2000">
                                        <div class="toast-header">
                                            <span><i class="fas fa-bell mr-3 text-warning"></i></span>
                                            <strong class="mr-auto text-warning">Thông Báo</strong>
                                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="toast-body" id="toast-notification-body">
                                            Hello, world! This is a toast message.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="container-fluid">
                    <h3 class="h2 font-weight-bold text-warning">
                        <span><i class="fas fa-comments"></i></span>
                        Đánh Giá - Nhận Xét Sản Phẩm
                    </h3>
                </div>
            </div>
        </div>
        <?php if ($currentUser) : ?>
            <div class="row my-2">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="container">
                        <div class="card d-flex flex-column">
                            <form action="" method="post" id="form-review">
                                <div class="form-group">
                                    <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Viết nhận xét...   " required></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="rating ml-3">
                                        <input type="radio" name="rating" value="5" id="5"><label for="5" class="h1 m-0">☆</label>
                                        <input type="radio" name="rating" value="4" id="4"><label for="4" class="h1 m-0">☆</label>
                                        <input type="radio" name="rating" value="3" id="3"><label for="3" class="h1 m-0">☆</label>
                                        <input type="radio" name="rating" value="2" id="2"><label for="2" class="h1 m-0">☆</label>
                                        <input type="radio" name="rating" value="1" id="1"><label for="1" class="h1 m-0">☆</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="btn-review" class="btn btn-primary ml-3" data-id="<?php echo $id_product; ?>">Gửi nhận xét </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <hr class="my-2">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="container" id="review">
                    <?php 
                        $reviewData = $database->fetchDataById("tbl_review", "id_product", $product->id_product);
                        foreach($reviewData as $data){
                            $name = $database->fetchDataById("tbl_account", "id_user", $data["id_user"])[0];
                            $name = $name["fullname"];
                            $star = $data["star"];
                            $time = $data["date_review"];
                            $message = $data["message"];
                            echo createCardReview($name, $star, $time, $message);
                        }
                    ?>
                </div>

                <div class="contaienr my-2 d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">&laquo;</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">&raquo;</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>
<?php else : ?>
    <div class="alert alert-danger my-2" role="alert">
        <strong>Không thể tải sản phẩm</strong>
    </div>
<?php endif; ?>
<div class="modal" id="product-notification-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            <div class="modal-body" id="product-body-content">
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
<div class="modal" id="review-notification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            <div class="modal-body" id="review-notification-body">
                <p class="h4 text-success"> Đã gửi nhận xét</p>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<?php
require_once __DIR__ . "/../../layouts/footer.php";
?>