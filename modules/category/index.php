<?php
require_once __DIR__ . "/../../autoload/autoload.php";
require_once __DIR__ . "/../../layouts/header.php";
require_once __DIR__ . "/../../layouts/navbar.php";
?>
<div class="container-fluid">
    <div class="row mt-2 d-flex justify-content-around" id="list-category">
        <?php
        if (isset($_GET["id"])) {
            $id_category = $_GET["id"];
            $sql = "SELECT * FROM `tbl_product` WHERE `id_category` = {$id_category} LIMIT 0, 6";
            $productData = $database->fetchSql($sql);
        }
        ?>
        <?php foreach ($productData as $data) : ?>
            <?php
                $product = new Product($data);
                $imgs = $database->fetchDataById("tbl_image_product", "id_product", $product->id_product);
                $sold = $database->getSold($product->id_product);
                echo createCardProduct($product, $imgs[0], $sold);
            ?>
        <?php endforeach; ?>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="contaienr d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">&laquo;</a>
                        </li>
                        <?php
                            $total_record = count($database->fetchDataById("tbl_product", "id_category", $id_category));
                            $limit = 6;
                            $total_page = ceil($total_record/$limit);
                        ?>
                        <?php for($i = 0; $i < $total_page; $i++): ?>
                            <li class="page-item">
                                <a class="page-link" data-category="<?php echo $id_category ?>" data-task="<?php echo "category" ?>" data-page="<?php echo $i + 1 ?>"> <?php echo $i + 1 ?></a>
                            </li>
                        <?php endfor; ?>
                        <li>
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