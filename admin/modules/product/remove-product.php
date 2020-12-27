<?php
    require_once __DIR__ . "/../../../autoload/autoload.php";
    if ($_POST["id_product"]) {
        $id_product = $_POST["id_product"];
        try {
            $imgs = $database->fetchDataById("tbl_product_img", "id_product", $id_product);
            if ($imgs != null) {
                foreach ($imgs as $img) {
                    $item = new ImageProduct($img);     
                    $database->delete("tbl_product_img", "id_product", $item->get_IdProduct());
                }
            }
            $database->delete("tbl_product", "id_product", $id_product);
            echo "<h4 class='modal-title w-100 text-success' id='myModalLabel'>Xóa Danh Mục Thành Công</h4>";
        } catch (PDOException $e) {
            echo "<h4 class='modal-title w-100 text-danger' id='myModalLabel'>Xóa Danh Mục Thất Bại. {$e->getMessage()}</h4>";
        }
    } else {
        echo " Có lỗi đã xảy ra !!! ";
    }
?>
