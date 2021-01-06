<?php
require_once __DIR__ . "/../../../autoload/autoload.php";
require_once __DIR__ . "/../../layouts/header.php";
?>
<!-- TODO Nội dung trang -->
<div class="container-fluid">
    <?php
    if (isset($_GET["role"])) {
        $role = $_GET["role"];
        if ($role == 0) {
            $name_role = "Admin";
        } else {
            $name_role = "Khác Hàng";
        }
        $sql = "SELECT * FROM `tbl_account` WHERE `role` = {$role}";
        try {
            $data = $database->fetchSql($sql);
        } catch (PDOException $e) {
            echo "Lỗi thao tác với database " . $e->getMessage();
        }
        $number_order = 1;
    }
    ?>
    <div class="d-sm-flex align-items-center justify-content-start mb-4">
        <a class="h3 mb-0 text-gray-800 font-weight-bold text-decoration-none" href="<?php echo ROOT . "/admin/modules/accounts/index.php"; ?>">
            <i class="fas fa-users"></i>
            Quản Lý Tài Khoản |
        </a>
        <span class="h3 mb-0 ml-2 text-gray-800 font-weight-bold text-decoration-none"><?php echo $name_role; ?></span>
    </div>
    <hr class="my-2">
    <?php if ($data) : ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Tài Khoản</th>
                    <th scope="col" class="text-center">Người Dùng</th>
                    <th scope="col" class="text-center">Giới Tính</th>
                    <th scope="col" class="text-center">Điện Thoại</th>
                    <th scope="col" class="text-center">Địa Chỉ</th>
                    <th scope="col" class="text-center">Thao tác</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $item) : ?>
                    <?php
                    $account = new Account($item);
                    ?>
                    <tr>
                        <th scope="row"><?php echo $number_order; ?></th>
                        <td class="text-center"><?php echo $account->username; ?></td>
                        <td class="text-center"><?php echo $account->fullname; ?></td>
                        <td class="text-center"><?php echo $account->gender; ?></td>
                        <td class="text-center"><?php echo $account->phone; ?></td>
                        <td class="text-center"><?php echo $account->address; ?></td>
                        <td class="text-center">
                            <a href="#" class="btn btn-info" data-toggle="modal" data-username="<?php echo $account->username; ?>" data-target="#account-change-role"><i class="fas fa-tools"></i></a>
                            <a href="#" class="btn btn-danger" data-toggle="modal" data-username="<?php echo $account->username; ?>" data-target="#account-verify-delete"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php $number_order++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="alert alert-primary" role="alert">
            <strong>Không có tài khoản</strong>
        </div>
    <?php endif; ?>
</div>
<div class="modal fade" id="account-notification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid modal-dialog-centered" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <h4 class="modal-title w-100 h3 text-primary font-weight-bold text-center" id="myModalLabel">Thông Báo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body" id="account-notification-body">
                ...
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>

<div class="modal fade" id="account-verify-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid modal-dialog-centered" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <h4 class="modal-title w-100 h3 text-primary font-weight-bold text-center" id="myModalLabel">Thông Báo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body" id="account-verify-delete-body">
                <p class="h3 text-danger">
                    Bạn thật sự muốn xóa người dùng này ?
                </p>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" id="account-btn-delete" class="btn btn-danger">Xác nhận</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Hủy</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<div class="modal fade" id="account-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid modal-dialog-centered" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <h4 class="modal-title w-100 h3 text-primary font-weight-bold text-center" id="myModalLabel">Thông Báo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body" id="account-detail">

            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<div class="modal fade" id="account-change-role" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid modal-dialog-centered" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <h4 class="modal-title w-100 h3 text-primary font-weight-bold text-center" id="myModalLabel">Thay Đổi Quyền</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body" id="account-change-role-body">
                <div class="input-group w-100 m-0">
                    <label class="input-group-text font-weight-bold" for="inputGroupSelect01">Quyền</label>
                    <select class="form-select ml-2 p-10" id="inputGroupSelect01">

                    </select>
                </div>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-change-role">Thay Đổi</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>

<?php
require_once __DIR__ . "/../../layouts/footer.php";
?>