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
        $star = $product->number_liked / 10;
        $imgs = $database->fetchDataById("tbl_image_product", "id_product", $id_product);
    } catch (PDOException $e) {
        echo "Có lỗi khi thao tác với database " . $e->getMessage();
    }
}
?>
<!-- Chi tiết sản phẩm -->
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php if ($product) : ?>
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
                                                        <?php for ($i = 0; $i < $star; $i++) : ?>
                                                            <span class="fa fa-star text-waring h3 m-0"></span>
                                                        <?php endfor; ?>
                                                        <?php for ($i = 0; $i < (5 - $star); $i++) : ?>
                                                            <span class="fa fa-star text-muted h3 m-0"></span>
                                                        <?php endfor; ?>
                                                        <span class="star-no text-warning font-weight-bold h3"><?php echo "(" . ($product->number_liked * 1.0 / 10) . ")"; ?></span>
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
                                <div class="container p-0">
                                    <div class="container m-0">
                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 p-0">
                                                <p class="text-primary font-italic h5 mx-1">Số Lượng: </p>
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <button type="button" class="btn btn-outline-danger btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                            <span class="fa fa-minus"></span>
                                                        </button>
                                                    </span>
                                                    <input type="text" id="quantity" name="quant[1]" class="form-control input-number text-center font-weight-bold" value="1" min="1" max="<?php echo $product->quantity; ?>">
                                                    <span class="input-group-append">
                                                        <button type="button" class="btn btn-outline-success btn-number" data-type="plus" data-field="quant[1]">
                                                            <span class="fa fa-plus"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row my-4">
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 my-2">
                                                <button type="button" class="btn btn-success w-100 py-2">
                                                    <span class="h4 m-0 mr-2"><i class="fas fa-cash-register"></i></span>
                                                    <span class="h4 m-0">Chọn Mua</span>
                                                </button>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 my-2">
                                                <button type="button" class="btn btn-danger w-100 py-2">
                                                    <span class="h4 m-0 mr-2"><i class="fas fa-heart"></i></span>
                                                    <span class="h4 m-0">Yêu Thích</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Có lỗi đã xảy ra</strong>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="container-fluid">
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
            <div class="row">

            </div>
        </div>
    </div>
</div>

<!-- Chi tiết sản phẩm-->
<?php
require_once __DIR__ . "/../../layouts/footer.php";
?>