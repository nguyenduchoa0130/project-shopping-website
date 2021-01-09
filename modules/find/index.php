<?php
require_once __DIR__ . "/../../autoload/autoload.php";
require_once __DIR__ . "/../../layouts/header.php";
require_once __DIR__ . "/../../layouts/navbar.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["key"])) {
        $key = $_GET["key"];
        $productData = $database->findProduct($key,0, 6);
    }
}
?>
<div class="container-fluid">
    <div class="row mt-2">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="container-fluid ">
                <div class="row d-flex justify-content-center" id="list-find">
                    <?php if ($productData) : ?>
                        <?php foreach ($productData as $data) : ?>
                            <?php
                            $product = new Product($data);
                            $imgs = $database->fetchDataById("tbl_image_product", "id_product", $product->id_product);
                            $sold = $database->getSold($product->id_product);
                            echo createCardProduct($product, $imgs[0],  $sold);
                            ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="alert alert-success my-2" role="alert">
                            <strong>Không có sản phẩm nào được tìm thấy</strong>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="contaienr d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">&laquo;</a>
                        </li>
                        <?php 
                            $total_record = count($database->findProduct($key));
                            $limit = 6;
                            $total_page = ceil($total_record/$limit)
                        ?>
                        <?php for($i = 0; $i <  $total_page; $i++): ?>
                            <li class="page-item">
                                <a class="page-link" data-key="<?php echo $key; ?> "data-task="<?php echo "find" ?>" data-page="<?php echo $i + 1 ?>"> <?php echo $i + 1 ?></a>
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


<?php
require_once __DIR__ . "/../../layouts/footer.php";
?>