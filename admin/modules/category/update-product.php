<?php
    require_once __DIR__ . "/../../../autoload/autoload.php";
    if($_POST["values"] && $_POST["id_product"]){
        $data = $_POST["values"];
        $id_product = $_POST["id_product"];
        $props = handleDataFormCategory($data);
        array_pop($props);
        try{
            $database->update("tbl_product", "id_product", $id_product, $props);
            echo "<h4 class='modal-title w-100 text-success' id='myModalLabel'>Cập Nhật Thành Công</h4>";
        }catch(PDOException $e){
            echo "<h4 class='modal-title w-100 text-danger' id='myModalLabel'>Cập Nhật Mục Thất Bại. {$e->getMessage()}</h4>";
        }
    }else{
        echo "Có lỗi đã xảy ra !!!!";
    }
?>