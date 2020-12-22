<?php
require_once __DIR__ . "/../../../autoload/autoload.php";
?>
<?php
require_once __DIR__ . "/../../layouts/header.php";
?>
<!-- TODO Nội dung trang -->
<div class="container-fluid">
    <?php
    if (!empty($_GET["id_category"]) && !empty($_GET["name"])) {
        $id = $_GET["id_category"];
        $name = $_GET["name"];
        $sql = "SELECT * FROM tbl_product WHERE id_category = {$id}";
        $data = $database->fetchSql($sql);
    ?>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a class="h3 mb-0 text-gray-800 font-weight-bold text-decoration-none" href="javascript:history.back()">
                <span><i class="fas fa-truck"></i></span>
                Quản Lý Đơn Sản Phẩm | <?php echo $name ?>
            </a>
            <button type="button" class="btn btn-primary waves-effect waves-light d-inline" data-toggle="modal" data-target="#addProduct">
                <span><i class="fas fa-plus"></i></span>
                Thêm Mới
            </button>
        </div>
        <hr class="my-4">

        <table class="table">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th scope="col">STT</th>
                    <th scope="col">Tên Sản Phẩm</th>
                    <th scope="col">Giá Bán</th>
                    <th scope="col">Số Lượng Còn Lại</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
            $count = 1;
            if ($data) {
                foreach ($data as $product) {
                    $item = new Product($product);
                    echo "
                        <tr class='text-center text-dark h5'>
                            <th scope='row'>{$count}</th>
                            <td>{$item->get_NameProduct()}</td>
                            <td>{$item->get_Price()}</td>
                            <td>{$item->get_Quantity()}</td>
                            <td class='text-right'>
                                <a class='btn btn-primary waves-effect waves-light' data-id='{$item->get_IdProduct()}' data-idcategory='{$id}' data-ncategory='{$name}' data-toggle='modal' data-target='#infoProduct' >
                                    <span><i class='fas fa-info-circle'></i></span>
                                     Chi Tiết Sản Phẩm
                                </a>
                            </td>
                        </tr>
                        ";
                    $count++;
                }
            } else {
                echo "
                        <div class='alert alert-success' role='alert'>
                            Không có sản phẩm nào !
                        </div>
                    ";
            }
        } else {
            echo "
                    <div class='alert alert-warning' role='alert'>
                        Không Tải Được Dữ Liệu
                    </div>
                ";
        }
            ?>
            </tbody>
        </table>
        <!-- Content Row Thêm Sản Phẩm-->
        <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <!--Content-->
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header text-center  bg-primary text-light">
                        <h4 class="font-weight-bold modal-title w-100" id="myModalLabel">Thêm Sản Phẩm</h4>
                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body p-3">
                        <form action="" method="post" id="formAddProduct" accept-charset="utf-8">
                            <div class="row">
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                    <div class="form-group">
                                        <label for="name_product">Tên Sản Phẩm</label>
                                        <input class="form-control" id="name_product" name="name_product" type="text" placeholder="Tên Sản Phẩm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Giá Bán</label>
                                        <input class="form-control" id="price" name="price" type="number" placeholder="Giá Bán" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Số Lượng</label>
                                        <input class="form-control" id="quantity" name="quantity" type="number" placeholder="Số Lượng" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="produced_at">Nơi Sản Xuất</label>
                                        <input class="form-control" id="produced_at" name="produced_at" type="text" placeholder="Nơi Sản Xuất" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Mô Tả</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                    </div>
                                    <div class="form-group d-none">
                                        <input class="form-control" id="id_category" name="id_category" type="text" value="<?php echo $id ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Mục</label>
                                        <input class="form-control" id="category" name="category" type="text" value="<?php echo $name ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <div class="alert alert-primary" role="alert">
                                        This is a primary alert—check it out!
                                    </div>
                                    <div class="alert alert-primary" role="alert">
                                        This is a primary alert—check it out!
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Thêm</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--Footer-->

                </div>
                <!--/.Content-->
            </div>
        </div>
        <!-- Content Row Thông Tin Sản Phẩm-->
        <div class="modal fade" id="infoProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <!--Content-->
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header text-center  bg-primary text-light">
                        <h4 class="font-weight-bold modal-title w-100" id="myModalLabel">Thông Tin Sản Phẩm</h4>
                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body modal-body-info p-3">

                    </div>
                </div>
            </div>
        </div>
        <!-- Content Row Xác Nhận Xóa-->
        <div class="modal fade" id="verifyDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger">Xóa</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Hủy</button>
                        </div>
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
        <!-- Content Row Thông Báo-->
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
        <!-- Content Row -->
</div>
<!-- TODO Nội dung trang -->
<?php
require_once __DIR__ . "/../../layouts/footer.php";
?>