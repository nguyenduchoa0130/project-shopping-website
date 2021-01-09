<?php
    require_once __DIR__. "/../../../autoload/autoload.php";
    if(isset($_POST["id_order"]) && $_POST["action"] && isset($_POST["dataSend"])){
        $noti = null;
        $id_order = $_POST["id_order"];
        $action = $_POST["action"];
        $dataSend = $_POST["dataSend"];
        if($action == 2){
            // chốt đơn
            // cập nhật trạng thái
            // cập nhật số lượng sản phẩm
            $date_delevery = new DateTime($dataSend[1]);
            try{
                $database->updateStatusOrder($id_order, C_SHIPPING, date_format($date_delevery, "Y-m-d"), null, null);
                $orderDetailData = $database->fetchDataById("tbl_order_detail", "id_order", $id_order);
                foreach($orderDetailData as $data){
                    $database->updateQuantityProduct($data["id_product"], $data["quantity"]);
                }
                $noti = new Notification(C_UPDATE, "Cập nhật thành công");
            }catch(PDOException $e){
                $noti = new Notification(C_ERROR, "Lỗi khi thao tác với database ". $e->getMessage());
            }
        }
        if($action == 4){
            // hủy đơn
            // cập nhật trạng thái
            try{
                $note = $dataSend[0];
                $database->updateStatusOrder($id_order, C_CANCELLED, null, null, $note);
                $noti = new Notification(C_CANCELLED, "Đã từ chối đơn hàng");
            }catch(PDOException $e){
                $noti = new Notification(C_ERROR, "Lỗi khi thao tác với database ". $e->getMessage());
            }
        }
       echo json_encode($noti); 
    }
?>