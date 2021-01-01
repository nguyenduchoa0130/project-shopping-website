<?php
require_once __DIR__ . "/../../autoload/autoload.php";

if (isset($_POST["values"])) {
    $data = handleDataForm($_POST["values"]);
    /**
     * TODO Kiểm tra dữ liệu
     * ! Có chứa tự khoảng trắng giữa các chữ hay không
     * ! Có chứa tự đặc biệt hay không
     * ! Loại bỏ Sql Injection vá XSS
     */
    $noti = null;
    try{
        $checkEmail = $database->findAccountByEmail($data["email"]);
        $checkUsername = $database->findAccountByUsername($data["username"]);
        if($data["password"] != $data["confirm-password"]){
            $noti = new Notification(0, "Mật khẩu nhập lại không đúng ");
        }else if($checkUsername){
            $noti = new Notification(0, "Tên đăng nhập đã tồn tại");
        }else if($checkEmail){
            $noti = new Notification(0, "Email đã được sử dụng cho 1 tài khoản khác");
        }else{
            $otp = rand(100000, 999999);
            $message = "Mã OTP của bạn là: "."<strong>{$otp}</strong>";
            sendEmail($data["email"], "Xác Thực Tài Khoản", $message);
            $checkOTP = $database->findOTPByUsername($data["username"]);
            if($checkOTP){
                $sql = "UPDATE `tbl_account_otp` SET `otp` = {$otp} WHERE `username` = '{$data['username']}'";
            }else{
                $sql = "INSERT INTO `tbl_account_otp`(`username`, `otp`) VALUES ('{$data['username']}', {$otp})";
            }
            if($database->executeNonQuery($sql)){
                $formVerifyOTP = createFormVerifyOTP($data['username'], $data["email"]);
                $noti = new Notification(1, $formVerifyOTP);
            }else{
                $noti = new Notification(0, "Lỗi thao tác khi thêm/chỉnh sửa dữ liệu");
            }
        }
    }catch(PDOException $e){
        $noti = new Notification(0, "Lỗi khi thao tác với database".$e->getMessage());
    }
   echo json_encode($noti);
}else if(isset($_POST["dataForm"])){
    $dataForm = handleDataForm($_POST["dataForm"]);
    $form = createFormVerifyProfileUser($dataForm);
    echo $form;
}else if(isset($_POST["completeData"])){
    $completeData = handleDataForm($_POST["completeData"]);
    $noti = null;
    try{
        $database->insert("tbl_account", $completeData);
        $noti = new Notification(1, "../index.php");
        $_SESSION["username"] = $completeData["username"];
    }catch(PDOException $e){
        $noti = new Notification(0, "Lỗi thao tác với database ". $e->getMessage());
    }
    echo json_encode($noti);
} else {
    echo "Có lỗi đã xảy ra !!!";
}
