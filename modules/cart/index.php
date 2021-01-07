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
        $cartData = $database->fetchDataById("tbl_cart", "id_user", $currentUser->id_user);
        if ($cartData) {
            $cart = new Cart($cartData[0]);
            $cartDetailData = $database->fetchDataById("tbl_cart_detail", "id_cart", $cart->id_cart);
        } else {
            $cartDetailData = null;
        }
        ?>
        <?php if ($cartDetailData) : ?>
            <div class="row d-flex justify-content-between">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 p-0 ml-3">
                    <div class="container">
                        <div class="row" id="list-cart-product">
                            <?php
                            $total_record  = count($cartDetailData);
                            $limit = 4;
                            $total_page = ceil($total_record / $limit);
                            foreach ($cartDetailData as $data) {
                                try {
                                    // lấy 4 sản phẩm đầu tiên
                                    $cartDetail = new CartDetail($data);
                                    $name_product = $database->getNameProduct($cartDetail->id_product);
                                    $quantityRemain = $database->fetchDataById("tbl_product", "id_product", $cartDetail->id_product)[0]["quantity"];
                                    $imgs = $database->fetchDataById("tbl_image_product", "id_product", $cartDetail->id_product);
                                    echo createCardProductCart($cartDetail->id_product, $name_product, $cartDetail->price,  $cartDetail->quantity, $quantityRemain, $imgs[0]);
                                } catch (PDOException $e) {
                                    echo "Lỗi khi thao tác với database " . $e->getMessage();
                                }
                            }

                            ?>
                        </div>

                        <div class="row d-flex justify-content-center">
                            <div class="contaienr">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">&laquo;</a>
                                        </li>
                                        <?php for ($i = 0; $i < $total_page; $i++) :  ?>
                                            <li class="page-item">
                                                <a class="page-link" data-task="<?php echo "listProductCart" ?>" data-page="<?php echo $i + 1 ?>"> <?php echo $i + 1 ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        <a class="page-link" href="#">&raquo;</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 my-2">
                    <div class="card">
                        <table class="table m-0" id="order-detail">
                            <thead>
                                <tr>
                                    <th class="font-weight-bold h3 text-primary text-center m-0" scope="col" colspan="5">Chi Tiết Đơn Hàng</th>
                                </tr>
                                <tr class="thread-light">
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Sản Phẩm</th>
                                    <th scope="col" class="text-center">Số Lượng</th>
                                    <th scope="col" class="text-center">Giá</th>
                                    <th scope="col" class="text-center">Thành Tiền</th>
                                </tr>
                            </thead>
                            <tbody id="order-detail-body">
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">

                                                </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 d-flex justify-content-end align-items-end">
                                                    <button class="btn btn-success h3 m-0 font-weight-bold"><span>Thanh Toán</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-success my-2" role="alert">
                <strong>Bạn không có sản phẩm nào. Hãy quay lại shop và chọn sản phẩm</strong>
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