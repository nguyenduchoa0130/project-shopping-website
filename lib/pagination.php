<?php
require_once __DIR__ . "/../autoload/autoload.php";
if (isset($_POST["task"]) && isset($_POST["page"])) {
    $task = $_POST["task"];
    $page = (int)$_POST["page"];
    $record = 10 - $page;
    $limit = ($record < 3) ? $record : 3;
    if ($task == "sellest") {
        try {
            $data = $database->getProductSellest($page, $limit);
            $render = "";
            foreach ($data as $item) {
                $product = new Product($item);
                $imgs = $database->fetchDataById("tbl_image_product", "id_product", $product->id_product);
                $render .= createCardProduct($product, $imgs[0]);
            }
            echo $render;
        } catch (PDOException $e) {
            echo "Có lỗi khi thao tác với database " . $e->getMessage();
        }
    }
    if ($task == "likest") {
        try {
            $data = $database->getProductLikest($page, $limit);
            $render = "";
            foreach ($data as $item) {
                $product = new Product($item);
                $imgs = $database->fetchDataById("tbl_image_product", "id_product", $product->id_product);
                $render .= createCardProduct($product, $imgs[0]);
            }
            echo $render;
        } catch (PDOException $e) {
            echo "Có lỗi khi thao tác với database " . $e->getMessage();
        }
    }
    if ($task == "new") {
        try {
            $data = $database->getProductNewest($page, $limit);
            $render = "";
            foreach ($data as $item) {
                $product = new Product($item);
                $imgs = $database->fetchDataById("tbl_image_product", "id_product", $product->id_product);
                $render .= createCardProduct($product, $imgs[0]);
            }
            echo $render;
        } catch (PDOException $e) {
            echo "Có lỗi khi thao tác với database " . $e->getMessage();
        }
    }
    
    if ($task== "productLike") {
        try {
            $user_id = $database->findAccountByUsername($_SESSION["username"])["id_user"];
            $data = $database->getProductLike($user_id, $page, $limit);
            $render = "";
            foreach ($data as $product) {
                $imgs = $database->fetchDataById("tbl_image_product", "id_product", $product->id_product);
                $render .= createCardProduct($product, $imgs[0]);
            }
            echo $render;
        } catch (PDOException $e) {
            echo "Có lỗi khi thao tác với database " . $e->getMessage();
        }
    }
}
