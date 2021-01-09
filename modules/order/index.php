<?php
require_once __DIR__ . "/../../autoload/autoload.php";
require_once __DIR__ . "/../../layouts/header.php";
require_once __DIR__ . "/../../layouts/navbar.php";
$count = 1;
$currentUser = $database->getCurrentUser();
if ($currentUser) {
    $currentUser = new Account($currentUser);
} else {
    $currentUser = null;
}
?>
<?php if ($currentUser) : ?>
    <div class="container-fluid">
        <div class="row my-2">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div class="input-group">
                    <select class="custom-select" id="status-order" aria-label="Example select with button addon">
                        <option selected></option>
                        <option value="1">Chờ xác nhận</option>
                        <option value="2">Đang giao hàng</option>
                        <option value="3">Đã giao</option>
                        <option value="4">Đã hủy</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-primary" type="button" id="btn-find-order">Tìm Đơn Hàng</button>
                    </div>
                    <input type="number" id="id-order" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                </div>
            </div>
        </div>
        <?php
        $orderData = $database->fetchDataById("tbl_order", "id_user", $currentUser->id_user);
        ?>
        <?php if ($orderData) : ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-0">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Mã ĐH</th>
                                <th scope="col" class="text-center">Ngày Đặt</th>
                                <th scope="col" class="text-center">Ngày Giao Dự Kiến</th>
                                <th scope="col" class="text-center">Ngày Hoàn Thành</th>
                                <th scope="col" class="text-center">Tình Trạng</th>
                                <th scope="col" class="text-center">Tổng Tiền</th>
                                <th scope="col" class="text-center">Ghi chú</th>
                                <th scope="col" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody id="table-order-body">
                            <?php foreach ($orderData as $data) : ?>
                                <?php
                                $order = new Order($data);
                                $status = new Status($order->status);
                                ?>
                                <tr>
                                    <th scope="col" class="text-center"><?php echo $count;$count++; ?></th>
                                    <td scope="col" class="text-center"><?php echo $order->id_order; ?></td>
                                    <td scope="col" class="text-center"><?php echo $order->date_created; ?></td>
                                    <td scope="col" class="text-center"><?php echo $order->date_delevery; ?></td>
                                    <td scope="col" class="text-center"><?php echo $order->date_completed; ?></td>
                                    <td scope="col" class="text-center"><?php echo $status->message; ?></td>
                                    <td scope="col" class="text-center"><?php echo $order->sum_cash ?></td>
                                    <td scope="col" class="text-center"><?php echo $order->note ?></td>
                                    <?php if ($status->status_code == 1) : ?>
                                        <td scope="col" class="text-center">
                                            <button type="button" class="btn btn-danger" data-id="<?php echo $order->id_order; ?>" data-toggle="modal" data-target="#order-cancel"><span><i class="fas fa-times"></i></span></button>
                                        </td>
                                    <?php else : ?>
                                        <td scope="col" class="text-center">
                                            <button type="button" class="btn btn-success" data-id="<?php echo $order->id_order; ?>" data-toggle="modal" data-target="#order-info"><span><i class="fas fa-calendar-week"></i></span></button>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-info my-2" role="alert">
                <strong>Bạn không có đơn hàng nào</strong>
            </div>
        <?php endif; ?>
        <div class="modal" id="order-cancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <!--Content-->
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <h4 class="modal-title w-100 font-weight-bold text-center text-primary" id="myModalLabel">Hủy Đơn Hàng</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body" id="order-cancel-body">
                        <div class="form-group my-2">
                            <label for="order-note" class="text-danger">Lý do hủy đơn:</label>
                            <textarea class="form-control" id="order-note" name="order-note" rows="3"></textarea>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger" id="btn-cancel-order">Hủy Đơn</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
        <div class="modal" id="order-notification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <!--Content-->
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <h4 class="modal-title w-100 font-weight-bold text-center text-primary" id="myModalLabel">Thông báo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body" id="order-notification-body">
                        ...
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
        <div class="modal" id="order-info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-fluid" role="document">
                <!--Content-->
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <h4 class="modal-title w-100 font-weight-bold text-center text-primary" id="myModalLabel">Thông Tin Đơn Hàng</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body" id="order-info-body">
                    </div>
                    <!--Footer-->
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="alert alert-danger my-2" role="alert">
        <strong>Bạn phải đăng nhập để thực hiện, chức năng này</strong>
    </div>
<?php endif; ?>

<?php
require_once __DIR__ . "/../../layouts/footer.php";
?>