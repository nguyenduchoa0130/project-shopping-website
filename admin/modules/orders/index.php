<?php
require_once __DIR__ . "/../../../autoload/autoload.php";
require_once __DIR__ . "/../../layouts/header.php";
$currentUser = $database->getCurrentUser();
$count = 1;
if ($currentUser) {
    $currentUser = new Account($currentUser);
} else {
    $currentUser = null;
}
?>
<!-- TODO Nội dung trang -->
<?php if ($currentUser) : ?>
    <?php if ($currentUser->role == 0) : ?>
        <div class="container-fluid">
            <!-- TODO Nội dung trang -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 font-weight-bold"> Quản Lý Đơn Hàng </h1>
            </div>
            <hr class="my-2">
            <div class="row">
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
            <div class="row my-2">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Mã ĐH</th>
                                <th scope="col" class="text-center">Người Đặt</th>
                                <th scope="col" class="text-center">Địa chỉ</th>
                                <th scope="col" class="text-center">SĐT</th>
                                <th scope="col" class="text-center">Ngày Đặt</th>
                                <th scope="col" class="text-center">Dự Kiến</th>
                                <th scope="col" class="text-center">Đã Giao</th>
                                <th scope="col" class="text-center">Tình Trạng</th>
                                <th scope="col" class="text-center">Tổng Tiền</th>
                                <th scope="col" class="text-center">Ghi chú</th>
                                <th scope="col" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody id="table-order-body">
                            <?php
                            $orderdata = $database->getOrderByStatus(1);
                            ?>
                            <?php foreach ($orderdata as $data) : ?>
                                <?php
                                $order = new Order($data);
                                $status = new Status($order->status);
                                $user =  $database->fetchDataById("tbl_account", "id_user", $order->id_user)[0];
                                $name_user =  $user["fullname"];
                                $address = $user["address"];
                                $phone = $user["phone"];
                                $a = new DateTime($order->date_created);
                                $b = new DateTime($order->date_delevery);
                                $c = new DateTime($order->date_completed);
                                $created = ($order->date_created != null) ? (date_format($a, "Y-m-d")) : "";
                                $delevery = ($order->date_delevery != null) ? (date_format($b, "Y-m-d")) : "";
                                $complete = ($order->date_completed != null) ? (date_format($c, "Y-m-d")) : "";
                                ?>
                                <tr>
                                    <th scope="row" class="text-center px-0"><?php echo $count;$count++; ?></th>
                                    <td class="text-center px-0"><?php echo $order->id_order ?></td>
                                    <td class="text-center px-0"><?php echo $name_user ?></td>
                                    <td class="text-center px-0"><?php echo $address ?></td>
                                    <td class="text-center px-0"><?php echo $phone ?></td>
                                    <td class="text-center px-0"><?php echo $created ?></td>
                                    <td class="text-center px-0"><?php echo $delevery?></td>
                                    <td class="text-center px-0"><?php echo $complete; ?></td>
                                    <td class="text-center px-0"><?php echo $status->message; ?></td>
                                    <td class="text-center px-0"><?php echo $order->sum_cash; ?></td>
                                    <td class="text-center px-0"><?php echo $order->note; ?></td>
                                    <td class="text-center px-0">
                                        <button class="btn btn-success btn-order-detail" data-date="<?php echo $order->date_created; ?>" data-id="<?php echo $order->id_order; ?>" data-toggle="modal" data-target="#order-detail"><i class="fas fa-calendar-week"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="contaienr d-flex justify-content-center">
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
            <!-- TODO Nội dung trang -->
            <div class="modal fade" id="order-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fluid" role="document">
                    <!--Content-->
                    <div class="modal-content">
                        <!--Header-->
                        <div class="modal-header">
                            <h4 class="modal-title w-100 font-weight-bold text-center text-primary" id="myModalLabel">Chi Tiết Đơn Hàng</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!--Body-->
                        <div class="modal-body" id="order-detail-body">
                            ...
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="btn-verify-order">Duyệt</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                    <!--/.Content-->
                </div>
            </div>
            <div class="modal fade" id="order-complete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fluid" role="document">
                    <!--Content-->
                    <div class="modal-content">
                        <!--Header-->
                        <div class="modal-header">
                            <h4 class="modal-title w-100 font-weight-bold text-center text-primary" id="myModalLabel">Cập Nhật Đơn Hàng</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!--Body-->
                        <div class="modal-body" id="order-complete-body">
                        </div>
                        <!--Footer-->
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-success" id="btn-complete">Đã giao hàng</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                    <!--/.Content-->
                </div>
            </div>
            <div class="modal fade" id="order-info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            <div class="modal fade" id="order-notification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fluid" role="document">
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
        <?php else : ?>
            <div class="alert alert-primary my-2" role="alert">
                <strong>Bạn không thể thực hiện thao tác này</strong>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <div class="alert alert-danger my-2" role="alert">
            <strong>Vui lòng đăng nhập để tiếp tục</strong>
            <a href="<?php echo ROOT . "/modules/account/login.php" ?>" class="font-weight-bold h6 m-0 text-primary"> Đăng Nhập</a>
        </div>
    <?php endif; ?>

    <?php require_once __DIR__ . "/../../layouts/footer.php"; ?>