<?php
require_once __DIR__ . "/../../../autoload/autoload.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_category = $_POST["id_category"];
    $name_category = urlencode($_POST["category"]);
    $props = array(
        "name_product" => $_POST["name_product"],
        "price" => $_POST["price"],
        "quantity" => $_POST["quantity"],
        "produced_at" => $_POST["produced_at"],
        "description" => $_POST["description"],
        "id_category" => $_POST["id_category"]
    );
    try {
        $id = $database->insert("tbl_product", $props);
        $imgs = array();
        for ($i = 1; $i < 4; $i++) {
            if(!empty($_FILES["image".$i]["name"])){
                $img = convertImageToBase64("image" . $i);
                if ($img) {
                    array_push($imgs, ["name" => $img["name"], "image" => $img["image"],"number_order" => $i, "id_product" => $id]);
                }
            }
        }
        foreach ($imgs as $img) {
            $database->insert("tbl_image_product", $img);
        }
        $_SESSION["notification"] = 1;
        header("Refresh:0; url=../category/category-detail.php?id_category={$id_category}&name={$name_category}");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>