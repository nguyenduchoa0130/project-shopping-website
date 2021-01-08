<?php
    require_once __DIR__. "/../../../autoload/autoload.php";
    if(isset($_POST["id_order"])){
        $id_order = $_POST["id_order"];
        $noti = null;
        try{
            $table = "
            <table class='table'>
                <thead class='thead-dark'>
                <tr>
                    <th scope='col' class='text-center'>#</th>
                    <th scope='col' class='text-center'>Mã Sản Phẩm</th>
                    <th scope='col' class='text-center'>Tên Sản Phẩm</th>
                    <th scope='col' class='text-center'>Số Lượng</th>
                    <th scope='col' class='text-center'>Giá</th>
                    <th scope='col' class='text-center'>Tổng tiền</th>
                </tr>
                </thead>
                <tbody id='table-order-detail-body'>
                ";
            $footer = "</tbody>
            </table>
                <hr class='my-2'>
            <div class='input-group mb-3' id='handle-order'>
                <div class='input-group-prepend'>
                    <label class='input-group-text' for='action-order'>Xử lý đơn hàng</label>
                </div>
                <select class='custom-select' id='action-order'>
                    <option selected></option>
                    <option value='2'>Chốt đơn</option>
                    <option value='4'>Từ chối</option>
                </select>
            </div>
                    ";
               
            $rows = "";
            $orderDetailData = $database->fetchDataById("tbl_order_detail", "id_order", $id_order);
            $count = 1;
            foreach($orderDetailData as $data){
                $name_product = $database->getNameProduct($data["id_product"]);
                $sum_price = $data['price'] * $data['quantity'];
                $rows.= "<tr>
                            <th scope='row' class='text-center'>$count</th>
                            <td class='text-center'>{$data['id_product']}</td>
                            <td class='text-center'>{$name_product}</td>
                            <td class='text-center'>{$data['quantity']}</td>
                            <td class='text-center'>{$data['price']}</td>
                            <td class='text-center'>{$sum_price}</td>
                        </tr>
                        ";
            }
            echo $table.$rows.$footer;
        }catch(PDOException $e){
            $noti = new Notification(C_ERROR, "Có lỗi khi thao tác với database ". $e->getMessage());
        }
    }
