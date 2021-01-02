<?php
require_once __DIR__ . "/../../../autoload/autoload.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            $img = convertImageToBase64("image" . $i);
            if ($img) {
                array_push($imgs, ["name" => $img["name"], "image" => $img["image"], "id_product" => $id]);
            }
        }
        foreach($imgs as $img){
            $database->insert("tbl_image_product", $img);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    exit();
}
