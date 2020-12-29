<?php
require_once __DIR__ . "/../../../autoload/autoload.php";
    if($_POST["values"] && $_POST['id_category']){
        $data = $_POST["values"];
        $id_category = $_POST['id_category'];
        $props = handleDataForm($data);
        try{
            $database->update("tbl_category", "id_category", $id_category,  $props);
            echo "<h4 class='modal-title w-100 text-success' id='myModalLabel'>Cập Nhật Thành Công</h4>";
        }catch(PDOException $e){
            echo "<h4 class='modal-title w-100 text-danger' id='myModalLabel'>Cập Nhật Thất Bại. {$e->getMessage()}</h4>";
        }
    }else{
        echo "Có lỗi đã xảy ra !!!";
    }
