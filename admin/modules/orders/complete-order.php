<?php
    require_once __DIR__. "/../../../autoload/autoload.php";
    if(isset($_POST["id_order"])){
        $noti = null;
        $id_order = $_POST["id_order"];
        $orderData = $database->fetchDataById("tbl_order","id_order", $id_order);
        $order = new Order($orderData[0]);
        $date_complete = new DateTime();
        try{
            $database->updateStatusOrder($id_order, C_DELIVERED, $order->date_delevery, date_format($date_complete, "Y-m-d"), null);
            $noti = new Notification(C_DELIVERED, "Cập nhật thành công");
        }catch(PDOException $e){
            $noti = new Notification(C_ERROR, "Lỗi thao tác với cơ sở dữ liệu ". $e->getMessage());
        }
        echo json_encode($noti);
    }
?>