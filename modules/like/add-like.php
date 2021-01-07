<?php
    require_once __DIR__. "/../../autoload/autoload.php";
    if(isset($_POST["id_user"]) && isset($_POST["id_product"])){
        $id_user = $_POST["id_user"];
        $id_product = $_POST["id_product"];
        $noti = null;
        
        try{
            $data = $database->findProductLike($id_user, $id_product);
            if($data){
                $database->deleteProductLike($id_user, $id_product);
                $database->subLike($id_product);
                $noti = new Notification(C_DELETE, "Đã xóa khỏi sản phẩm yêu thích");
            }else{
                $props = array("id_user" => $id_user, "id_product" => $id_product);
                $database->insert("tbl_like", $props);
                $database->addLike($id_product);
                $noti = new Notification(C_ADD, "Đã thêm vào yêu thích");
            }
        }catch(PDOException $e){
            $noti = new Notification(0, "Lỗi khi thao tác với database ". $e->getMessage());
        }
        echo json_encode($noti);
    }else{
        echo"
        <div class='alert alert-danger' role='alert'>
            <strong>Có lỗi đã xảy ra</strong>
        </div>
        " ;
    }
?>