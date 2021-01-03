<?php
require_once __DIR__ . "/../../../autoload/autoload.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_product = $_POST["id_product"];
    $id_category = $_POST["id_category"];
    $name_category = urlencode($_POST["category"]);
    $props = array(
        "name_product" => $_POST["name_product"],
        "price" => $_POST["price"],
        "quantity" => $_POST["quantity"],
        "produced_at" => $_POST["produced_at"],
        "description" => $_POST["description"],
    );
    try {
        $data_img = $database->fetchDataById("tbl_image_product", "id_product", $id_product);
        $database->update("tbl_product", "id_product", $id_product, $props);
        header("Refresh:0; url=../product/index.php?id_product={$id_product}&name_category={$name_category}");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
