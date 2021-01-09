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
        $user =  $database->fetchDataById("tbl_account", "id_user", $order->id_user)[0];
        $name_user =  $user["fullname"];
        $address = $user["address"];
        $phone = $user["phone"];
        $a = new DateTime($order->date_created);
        $b = new DateTime($order->date_delevery);
        $c = new DateTime($order->date_completed);
        $created = ($order->date_created != null) ? (date_format($a, "Y-m-d")) : "";
        $delevery = ($order->date_delevery != null) ? (date_format($b, "Y-m-d")) : "";
        $complete = ($order->date_completed != null) ? (date_format($c, "Y-m-d")) : "";
        $rows .=
            "
            <tr>
                <th scope='row' class='text-center'>{$count}</th>
                <td class='text-center'>$order->id_order</td>
                <td class='text-center'>$name_user</td>
                <td class='text-center'>$address</td>
                <td class='text-center'>$phone</td>
                <td class='text-center'>$created</td>
                <td class='text-center'>$delevery</td>
                <td class='text-center'>$complete</td>
                <td class='text-center'>$status->message</td>
                <td class='text-center'>$order->sum_cash</td>
                <td class='text-center'>$order->note</td>
                ";
        if ($status->status_code == 1) {
            $rows .= "
                <td class='text-center'>
                    <button class='btn btn-success btn-order-detail' date-date='$order->date_created' data-id='$order->id_order' data-toggle='modal' data-target='#order-detail'><i class='fas fa-calendar-week'></i></button>
                </td>
            </tr>
            ";
        } else if ($status->status_code == 2) {
            $rows .= "
                <td class='text-center'>
                    <button class='btn btn-success btn-order-complete' data-id='$order->id_order' data-toggle='modal' data-target='#order-complete'><i class='fas fa-calendar-week'></i></button>
                </td>
            </tr>
            ";
        } else {
            $rows .= "
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
