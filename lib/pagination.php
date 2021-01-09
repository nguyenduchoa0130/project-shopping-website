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
                $product = $database->fetchDataById("tbl_product", "id_product", $item["id_product"])[0];
                $product = new Product($product);
                $imgs = $database->fetchDataById("tbl_image_product", "id_product", $product->id_product);
                $sold = $database->getSold($product->id_product);
                $render .= createCardProduct($product, $imgs[0], $sold);
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
                $sold = $database->getSold($product->id_product);
                $render .= createCardProduct($product, $imgs[0], $sold);
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
                $sold = $database->getSold($product->id_product);
                $render .= createCardProduct($product, $imgs[0], $sold);
            }
            echo $render;
        } catch (PDOException $e) {
            echo "Có lỗi khi thao tác với database " . $e->getMessage();
        }
    }
    if ($task == "productLike") {
        try {
            $user_id = $database->findAccountByUsername($_SESSION["username"])["id_user"];
            $data = $database->getProductLike($user_id, $page, 6);
            $render = "";
            foreach ($data as $product) {
                $imgs = $database->fetchDataById("tbl_image_product", "id_product", $product->id_product);
                $render .= createCardProductLike($product, $imgs[0]);
            }
            echo $render;
        } catch (PDOException $e) {
            echo "Có lỗi khi thao tác với database " . $e->getMessage();
        }
    }
    if ($task == "comment") {
        $id_product = $_POST["id_product"];
        try {
            $reviewData = $database->getComment($id_product, $page, 6);
            $render = "";
            foreach ($reviewData as $data) {
                $name = $database->fetchDataById("tbl_account", "id_user", $data["id_user"])[0];
                $name = $name["fullname"];
                $star = $data["star"];
                $time = $data["date_review"];
                $message = $data["message"];
                $render .= createCardReview($name, $star, $time, $message);
            }
            echo $render;
        } catch (PDOException $e) {
            echo "Có lỗi khi thao tác với database " . $e->getMessage();
        }
    }
    if ($task == "cart") {
        $id_user = $_POST["id_user"];
        try {
            $dataCartDetail = $database->getCartDetailLimit($id_user, $page, 4);
            $render = "";
            foreach ($dataCartDetail as $data) {
                $cartDetail = new CartDetail($data);
                $name_product = $database->getNameProduct($cartDetail->id_product);
                $quantityRemain = $database->fetchDataById("tbl_product", "id_product", $cartDetail->id_product)[0]["quantity"];
                $imgs = $database->fetchDataById("tbl_image_product", "id_product", $cartDetail->id_product);
                $render .= createCardProductCart($cart->id_cart, $cartDetail->id_product, $name_product, $cartDetail->price,  $cartDetail->quantity, $quantityRemain, $imgs[0]);
            }
            echo $render;
        } catch (PDOException $e) {
            echo "Có lỗi khi thao tác với cơ sở dữ liệu " . $e->getMessage();
        }
    }
    if ($task == "find") {
        $key = $_POST["key"];
        $render = "";
        try {
            $productData = $database->findProduct($key, $page, 6);
            foreach ($productData as $data) {
                $product = new Product($data);
                $imgs = $database->fetchDataById("tbl_image_product", "id_product", $product->id_product);
                $sold = $database->getSold($product->id_product);
                $render .= createCardProduct($product, $imgs[0],  $sold);
            }
        } catch (PDOException $e) {
            echo "Có lỗi khi thao tác với database " . $e->getMessage();
        }
        echo $render;
    }
    if ($task == "category") {
        $id_category = $_POST["id_category"];
        $sql = "SELECT * FROM `tbl_product` WHERE `id_category` = {$id_category} LIMIT $page, 6";
        $productData = $database->fetchSql($sql);
        $render = "";
        foreach ($productData as $data) {
            $product = new Product($data);
            $imgs = $database->fetchDataById("tbl_image_product", "id_product", $product->id_product);
            $sold = $database->getSold($product->id_product);
            $render.= createCardProduct($product, $imgs[0], $sold);
        }
        echo $render;
    }
}
