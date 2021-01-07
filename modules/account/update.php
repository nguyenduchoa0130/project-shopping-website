<?php
require_once __DIR__ . "/../../autoload/autoload.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST["id_user"];
    $confirm_password = $_POST["confirm-password"];
    $password = $_POST["password"];
    if ($password != $confirm_password) {
        echo "lỗi sai password lập lại:";
    } else {
        $password = hashPassword($password);
        $props = array(
            "password" => $password,
            "fullname" => $_POST["fullname"],
            "gender" => $_POST["gender"],
            "birth" => $_POST["birth"],
            "address" => $_POST["address"]
        );

        try {
            $data_img = $database->fetchDataById("tbl_account", "id_user", $id_user);
            $database->update("tbl_account", "id_user", $id_user, $props);
            $_SESSION["notification"] = 1;
            header("Location: index.php");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
