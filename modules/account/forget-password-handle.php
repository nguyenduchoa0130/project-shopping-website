<?php
require_once __DIR__ . "/../../autoload/autoload.php";
    if(isset($_POST["dataForm"])){
        $dataForm = handleDataForm($_POST["dataForm"]);
        try{
            $checkAccount = $database->findAccountByUsername($dataForm["username"]);
            $noti = null;
            if(!$checkAccount){
                $noti = new Notification(0, "Không tìm thấy tài khoản");
            }else{
                $otp = rand(100000, 999999);
                $message = "Mã OTP của bạn là: "."<strong>{$otp}</strong>";
                sendEmail($checkAccount["email"], "Lấy lại mật khẩu", $message);    
                $checkOTP = $database->findOTPByUsername($checkAccount["username"]);
                if($checkOTP){
                    $sql = "UPDATE `tbl_account_otp` SET `otp` = {$otp} WHERE `username` = '{$checkAccount['username']}'";
                }else{
                    $sql = "INSERT INTO `tbl_account_otp`(`username`, `otp`) VALUES ('{$checkAccount['username']}', {$otp})";
                }
                if($database->executeNonQuery($sql)){
                    $formVerifyOTP = createFormVerifyOTP($checkAccount["username"], $checkAccount["email"]);
                    $noti = new Notification(1, $formVerifyOTP);
                }else{
                    $noti = new Notification(0, "Lỗi thao tác khi thêm/chỉnh sửa dữ liệu");
                }
            }
        }catch(PDOException $e){
            $noti = new Notification(0, "Lỗi khi thao tác với database ". $e->getMessage());
        }
        echo json_encode($noti);
    }else if(isset($_POST["completeForm"])){
        $data = handleDataForm($_POST["completeForm"]);
        $form = createFormForgetPassword($data["username"]);
        echo $form;
    }else if(isset($_POST["newPassword"])){
        $data = handleDataForm($_POST["newPassword"]);
        $noti = null;
        if(strlen($data["password"]) < 6){
            $noti = new Notification(0, "Mật khẩu phải có ít nhất 6 ký tự");
        }else if($data["password"] != $data["confirm-password"]){
            $noti = new Notification(0, "Xác nhận mật khẩu không đúng");
        }else{
            try{
                $data["password"] = hashPassword($data["password"]);
                $sql = "UPDATE `tbl_account` SET `password` = '{$data['password']}' WHERE `username` = '{$data['username']}'";
                if($database->executeNonQuery($sql)){
                    $noti = new Notification(1, "");
                    $_SESSION["username"] = $data["username"];
                }
            }catch(PDOException $e){
                $noti = new Notification(0, "Lỗi thao tác với database ". $e->getMessage());
            }
        }
        echo json_encode($noti);
    }else{
        echo "Có lỗi nghiêm trọng đã xảy ra";   
    }
?>