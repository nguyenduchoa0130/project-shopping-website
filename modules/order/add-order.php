<?php
    require_once __DIR__ . "/../../autoload/autoload.php";
    if(isset($_POST["data"]) && isset($_POST["id_user"])){
        $noti = null;
        $id_user = $_POST["id_user"];
        $address_ship = $_POST["address_ship"];
        $ship_cash = (int)$_POST["ship_cash"];
        $sum_cash = (int)$_POST["sum_cash"];
        $dataSend = json_decode($_POST["data"]);
        $orderDetailData = array();
        foreach($dataSend as $data){
            $str = "";
            foreach($data as $key => $value){
                $str.=$key."=".$value."&";
            }
            $str = substr($str, 0, strlen($str) - 1);
            array_push($orderDetailData, $str);
        }
        try{
            $props = array(
                "id_user" =>$id_user,
                "address_ship" => $address_ship,
                "ship_cash" => $ship_cash,
                "sum_cash" => $sum_cash
            );
            $id_order = $database->insert("tbl_order", $props);
            foreach($orderDetailData as $item){
                $cartDetail = handleDataForm($item);
                $props = array(
                    "id_order" => $id_order,
                    "id_product" => $cartDetail["id_product"],
                    "quantity" => $cartDetail["quantity"],
                    "price" => $cartDetail["price"],
                );  
                $database->insert("tbl_order_detail", $props);
            }
            $url = ROOT."/modules/order/index.php";
            $noti = new Notification(C_ADD, "<p class='h4 m-0 text-success'>Đặt hàng thành công</p>
                                                <p class='h4 m-0 text-success'>
                                                     Kiểm tra tình trạng <a href='{$url}' class='link'>đơn hàng</a>
                                                </p>"
                                    );
        }catch(PDOException $e){
            $noti = new Notification(C_ERROR, "Có lỗi xảy ra khi thực hiện thao tác với database ". $e->getMessage());
        }
        echo json_encode($noti);
    }else{
        echo "Có lỗi đã xảy ra";
    }
