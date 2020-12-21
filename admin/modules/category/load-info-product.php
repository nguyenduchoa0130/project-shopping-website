<?php
require_once __DIR__ . "/../../../autoload/autoload.php";
if ($_POST["id_product"] && $_POST["id_category"] && $_POST["name_category"]) {
    $id_product = $_POST["id_product"];
    $name_category = $_POST["name_category"];
    $id_category = $_POST["id_category"];

    $data = $database->fetchsql("select * from tbl_product where id_product = {$id_product}");
    if($data){
        $product = new Product($data[0]);
        $imgs = $database->fetchsql("select * from tbl_product_img as a, tbl_product as b where a.id_product = b.id_product and b.id_product =  {$id_product}");
        $render = createFormProductDetail($id_category, $name_category, $product, $imgs);
        echo $render;
    }else{
        echo "
            <div class='alert alert-info' role='alert'>
                This is a info alert with <a href='#' class='alert-link'>an example link</a>. Give it a click if you like.
            </div>
            ";
    }
    
}
?>