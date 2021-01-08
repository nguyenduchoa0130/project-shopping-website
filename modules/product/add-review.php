<?php
    require_once __DIR__. "/../../autoload/autoload.php";
    if(isset($_POST["id_user"]) && isset($_POST["id_product"]) && isset($_POST["dataReview"])){
        $noti = null;
        $id_user = $_POST["id_user"];
        $id_product = $_POST["id_product"];
        $dataReview = handleDataForm($_POST["dataReview"]); 
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $timezone = date_default_timezone_get();
        $props = array(
            "id_user" => $id_user,
            "id_product" => $id_product,
            "star" => isset($dataReview["rating"]) ? $dataReview["rating"] : 0,
            "message" => $dataReview["comment"]
        );
        try{
            if($props["star"] == 0){
                $noti = new Notification(C_ERROR, "Vui lòng đánh giá số sao");
            }
            else if($database->insert("tbl_review", $props)){
                $noti = new Notification(C_ADD, "Đã gửi nhận xét và đánh giá");
            }else{
                $noti = new Notification(C_ERROR, "Lỗi");
            }
            
        }catch(PDOException $e){
            $noti = new Notification(C_ERROR, "Lỗi khi tao tác với database ". $e->getMessage());
        }
        echo json_encode($noti);
    }else{
        echo "
        <div class='alert alert-danger my-2' role='alert'>
            <strong>Có lỗi đã xảy ra</strong>
        </div>
        ";
        
    }
?>