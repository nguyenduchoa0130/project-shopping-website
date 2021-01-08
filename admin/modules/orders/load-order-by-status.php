<?php
require_once __DIR__ . "/../../../autoload/autoload.php";
if (isset($_POST["status"])) {
    $status = (int)$_POST["status"];
    $orderData = $database->fetchDataById("tbl_order", "status", $status);
    $count = 1;
    $rows = "";
    foreach ($orderData as $data) {
        $order = new Order($data);
        $status = new Status($order->status);
        $name_user = $database->fetchDataById("tbl_account", "id_user", $order->id_user)[0]["fullname"];
        $dateDelevery = ($order->date_delevery != null) ? $order->date_delevery : '--/--/----';
        $dateCompleted = ($order->date_completed != null) ? $order->date_completed : '--/--/----';
        $rows .=
            "
            <tr>
                <th scope='row' class='text-center'>{$count}</th>
                <td class='text-center'>$order->id_order</td>
                <td class='text-center'>$name_user</td>
                <td class='text-center'>$order->date_created</td>
                <td class='text-center'>
                     $dateDelevery
                </td>
                <td class='text-center'>
                    {$dateCompleted}
                </td>
                <td class='text-center'>$status->message</td>
                <td class='text-center'>$order->sum_cash</td>
                <td class='text-center'>$order->note</td>
                ";
            if($status->status_code == 1){
                $rows.= "
                <td class='text-center'>
                    <button class='btn btn-success btn-order-detail' date-date='$order->date_created' data-id='$order->id_order' data-toggle='modal' data-target='#order-detail'><i class='fas fa-calendar-week'></i></button>
                </td>
            </tr>
            ";
            }else if($status->status_code == 2){
                $rows.= "
                <td class='text-center'>
                    <button class='btn btn-success btn-order-complete' data-id='$order->id_order' data-toggle='modal' data-target='#order-complete'><i class='fas fa-calendar-week'></i></button>
                </td>
            </tr>
            ";
            }else{
                $rows.= "
                <td class='text-center'>
                    <button class='btn btn-success btn-order-info' data-id='$order->id_order' data-toggle='modal' data-target='#order-info'><i class='fas fa-calendar-week'></i></button>
                </td>
            </tr>
            ";
            }
            
        $count++;
    }
    echo $rows;
}
