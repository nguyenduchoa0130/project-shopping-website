<?php
require_once __DIR__ . "/../../../autoload/autoload.php";
if ($_POST["id_category"]) {
    $id_category = $_POST["id_category"];
    try {
        $products = $database->fetchDataById("tbl_product", "id_category", $id_category);
        if ($products != null) {
            foreach ($products as $product) {
                $item = new Product($product);
                if($database->fetchDataById("tbl_product_img", "id_product", $item->get_IdProduct())){
                    $database->delete("tbl_product_img", "id_product", $item->get_IdProduct());
                }        
                $database->delete("tbl_product", "id_product", $item->get_IdProduct());
            }
        }
        $database->delete("tbl_category", "id_category", $id_category);
        echo "<h4 class='modal-title w-100 text-success' id='myModalLabel'>Xóa Danh Mục Thành Công</h4>";
    } catch (PDOException $e) {
        echo "<h4 class='modal-title w-100 text-danger' id='myModalLabel'>Xóa Danh Mục Thất Bại. {$e->getMessage()}</h4>";
    }
} else {
    echo "Có Lỗi Đã Xảy Ra !!!";
}
