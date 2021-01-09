<?php
    require_once __DIR__. "/../../autoload/autoload.php";
    if(isset($_POST["id_cart"]) && isset($_POST["id_product"])){
        $id_cart = (int)$_POST["id_cart"];
        $id_product = (int)$_POST["id_product"];
        try{
            $sql = "DELETE FROM `tbl_cart_detail` WHERE `id_cart` = {$id_cart} AND `id_product` = {$id_product}";
            $database->executeNonQuery($sql);
        }catch(PDOException $e){
            echo "Có lỗi xảy ra khi thao tác với database ". $e->getMessage();
        }
    }
?>