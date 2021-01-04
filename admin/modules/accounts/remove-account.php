<?php
require_once __DIR__ . "/../../../autoload/autoload.php";
if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $noti = null;
    $account = $database->findAccountByUsername($username);
    $account = new Account($account);
    try {
        $account = $database->findAccountByUsername($username);
        $account = new Account($account);
        if ($account->role == 0) {
            $noti = new Notification(0, "Không thể xóa tài khoản của quản trị viên");
        } else {
            $database->delete("tbl_account", "id_user", $account->id_user);
            $noti = new Notification(1, "");
        }
    } catch (PDOException $e) {
        $noti = new Notification(0, "Lỗi khi thao tác với database " . $e->getMessage());
    }
    echo json_encode($noti);
} else {
    echo "
        <div class='alert alert-danger' role='alert'>
            <strong>Có lỗi đã xảy ra</strong>
        </div>
            ";
}
