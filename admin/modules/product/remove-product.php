<?php
    require_once __DIR__ . "/../../../autoload/autoload.php";
    if ($_POST["id"]) {
        $id_product = $_POST["id"];
        try {
            $database->delete("tbl_image_product", "id_product", $id_product);
            $database->delete("tbl_product", "id_product", $id_product);
            echo "<h4 class='modal-title w-100 text-success' id='myModalLabel'>Xóa Danh Mục Thành Công</h4>";
        } catch (PDOException $e) {
            echo "<h4 class='modal-title w-100 text-danger' id='myModalLabel'>Xóa Danh Mục Thất Bại. {$e->getMessage()}</h4>";
        }
    } else {
        echo " Có lỗi đã xảy ra !!! ";
    }
?>
