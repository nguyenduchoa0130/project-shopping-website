<?php
require_once __DIR__ . "/../autoload/autoload.php";
require_once __DIR__ . "/layouts/header.php";
$currentUser = $database->getCurrentUser();
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
                <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Trang Chủ</h1>
            </div>
            <hr class="my-2">
            <!-- TODO Nội dung trang -->
        <?php else : ?>
            <div class="alert alert-primary my-2" role="alert">
                <strong>Bạn không thể thực hiện thao tác này</strong>
            </div>
        <?php endif; ?>
<?php else : ?>
    <div class="alert alert-danger my-2" role="alert">
        <strong>Vui lòng đăng nhập để tiếp tục</strong>
        <a href="<?php echo ROOT."/modules/account/login.php"?>" class="font-weight-bold h6 m-0 text-primary"> Đăng Nhập</a>
    </div>
<?php endif; ?>

<?php require_once('./layouts/footer.php') ?>
