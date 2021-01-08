<?php
require_once __DIR__ . "/../../autoload/autoload.php";
require_once __DIR__ . "/../../layouts/header.php";
require_once __DIR__ . "/../../layouts/navbar.php";
$currentUser = $database->getCurrentUser();
if ($currentUser) {
    $currentUser = new Account($currentUser);
} else {
    $currentUser = null;
}
?>
<?php if ($currentUser) : ?>
    <div class="container-fluid">
        <?php
        $orderData = $database->fetchDataById("tbl_order", "id_user", $currentUser->id_user);
        ?>
        <?php if ($orderData) : ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-0 my-2">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Mã Đơn Hàng</th>
                                <th scope="col" class="text-center">Ngày đặt</th>
                                <th scope="col" class="text-center">Tình trạng</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-info my-2" role="alert">
                <strong>Bạn không có đơn hàng nào</strong>
            </div>
        <?php endif; ?>
    </div>
<?php else : ?>
    <div class="alert alert-danger my-2" role="alert">
        <strong>Bạn phải đăng nhập để thực hiện, chức năng này</strong>
    </div>
<?php endif; ?>

<?php
require_once __DIR__ . "/../../layouts/footer.php";
?>