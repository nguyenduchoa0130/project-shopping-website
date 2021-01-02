<?php
require_once __DIR__ . "/../../autoload/autoload.php";
if ($_POST["values_otp"]) {
    $data = handleDataForm($_POST["values_otp"]);
    try{
        $checkOTP = $database->findOTPByUsername($data["username"]);
        $noti = null;
        if ($data["otp"] != $checkOTP["otp"]) {
            $noti = new Notification(0, "Mã OTP không đúng");
        } else {
            $sql = "UPDATE `tbl_account_otp` SET `otp` = null  WHERE `username` = '{$checkOTP['username']}'";
            $database->executeNonQuery($sql);
            $noti = new Notification(1, "Xác thực thành công");
        }
    }catch(PDOException $e){
        $noti = new Notification(0, "Lỗi thao tác với database ". $e->getMessage());
    }
    echo json_encode($noti);
}else{
    echo "Có lỗi đã xảy ra";
}
