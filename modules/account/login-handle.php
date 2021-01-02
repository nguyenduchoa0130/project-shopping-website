<?php
require_once __DIR__ . "/../../autoload/autoload.php";
if (isset($_POST["infoAccount"])) {
    $infoAccount = handleDataForm($_POST["infoAccount"]);
    // kiểm tra tài khoản
    // tên đăng nhập
    $noti = null;
    try{
        $checkAccount = $database->findAccountByUsername($infoAccount["username"]);
        if (!$checkAccount) {
            $noti = new Notification(0, "Không tìm thấy tài khoản");
        } else if (!password_verify($infoAccount["password"], $checkAccount["password"])) {
            $noti = new Notification(0, "Sai mật khẩu");
        }else{
            $_SESSION["username"] = $checkAccount["username"];
            $noti = new Notification(1, "");
        }
    }catch(PDOException $e){
        $noti = new Notification(0, "Có lỗi đã xảy ra khi thao tác với database ". $e->getMessage());
    }
    echo json_encode($noti);
} else {
    echo "Có lỗi đã xảy ra";
}
?>