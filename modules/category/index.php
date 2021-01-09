<?php
require_once __DIR__ . "/../../autoload/autoload.php";
require_once __DIR__ . "/../../layouts/header.php";
require_once __DIR__ . "/../../layouts/navbar.php";
?>
<div class="container-fluid">

    <div class="row mt-2 d-flex justify-content-around">
        <?php
        if (isset($_GET["id"])) {
            $id_category = $_GET["id"];
            $productData = $database->fetchDataById("tbl_product", "id_category", $id_category);
        }
        ?>
        <?php foreach ($productData as $data) : ?>
            <?php
            $product = new Product($data);
            $imgs = $database->fetchDataById("tbl_image_product", "id_product", $product->id_product);
            echo createCardProduct($product, $imgs[0]);
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

</div>
<?php
require_once __DIR__ . "/../../layouts/footer.php";
?>