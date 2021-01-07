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
                
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    
                </div>

                
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    
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