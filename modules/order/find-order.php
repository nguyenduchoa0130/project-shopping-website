<?php
    require_once __DIR__. "/../../autoload/autoload.php";
    if(isset($_POST["id_order"]) && isset($_POST["id_user"])){
        $id_user = (int)$_POST["id_user"];
        $id_order = (int)$_POST["id_order"];
        $sql = "SELECT * FROM `tbl_order` WHERE `id_order` = $id_order AND `id_user` = $id_user";
        $orderData = $database->fetchSql($sql);
        $count = 1;
        $rows = "";
        foreach ($orderData as $data) {
            $order = new Order($data);
            $status = new Status($order->status);
            $rows .=
                "
                <tr>
                    <th scope='row' class='text-center'>{$count}</th>
                    <td class='text-center'>$order->id_order</td>
                    <td class='text-center'>$order->date_created</td>
                    <td class='text-center'>$order->date_delevery</td>
                    <td class='text-center'>$order->date_completed</td>
                    <td class='text-center'>$status->message</td>
                    <td class='text-center'>$order->sum_cash</td>
                    <td class='text-cyenter'>$order->note</td>
                    ";
                    if($status->status_code == 1){
                        $rows.= "
                        <td scope='col' class='text-center'>
                            <button type='button' class='btn btn-success' data-id='$order->id_order' data-toggle='modal' data-target='#order-info'><span><i class='fas fa-calendar-week'></i></span></button>
                            <button type='button' class='btn btn-danger' data-id='$order->id_order' data-toggle='modal' data-target='#order-cancel'><span><i class='fas fa-times'></i></span></button>
                        </td>
                    </tr>
                    ";
                    }else{
                        $rows.= "
                        <td scope='col' class='text-center'>
                            <button type='button' class='btn btn-success' data-id='$order->id_order' data-toggle='modal' data-target='#order-info'><span><i class='fas fa-calendar-week'></i></span></button>
                        </td>
                    </tr>
                    ";
                }
                
            $count++;
        }
        echo $rows;
    }
?>