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
    <div class="container-fluid position-relative">
        <!-- Sản Phẩm -->
        <div class="row d-flex justify-content-around m-2" id="list-product-like">
            <?php
            $data = $database->fetchDataById("tbl_like", "id_user", $currentUser->id_user);
            // data chứa id_user và id_product
            $total_record = count($data);
            $limit = 6;
            $total_page = (ceil($total_record / $limit));
            // lấy sản phẩm yêu thích
            $listProducts = $database->getProductLike($currentUser->id_user, 0, 6);
            $render = "";
            foreach ($listProducts as $product) {
                $imgs = $database->fetchDataById("tbl_image_product", "id_product", $product->id_product);
                $render.= createCardProductLike($product, $imgs[0]);
            }
            echo $render;
            ?>
        </div>
        <!-- Sản Phẩm -->
        <!-- Phân Trang -->
        <div class="row d-flex justify-content-center">
            <div class="contaienr">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">&laquo;</a>
                        </li>
                        <?php for ($i = 0; $i < $total_page; $i++) :  ?>
                            <li class="page-item">
                                <a class="page-link" data-task="<?php echo "productLike" ?>" data-page="<?php echo $i + 1 ?>"> <?php echo $i + 1 ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="#">&raquo;</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class='toast' id='toast-notification' style='position: absolute; top: 0; right: 30px;' data-delay='2000'>
            <div class='toast-header'>
                <span><i class='fas fa-bell mr-3 text-warning'></i></span>
                <strong class='mr-auto text-warning'>Thông Báo</strong>
                <button type='button' class='ml-2 mb-1 close' data-dismiss='toast' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
            </div>
            <div class='toast-body' id='toast-notification-body'>
                Hello, world! This is a toast message.
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