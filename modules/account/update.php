<?php
require_once __DIR__ . "/../../autoload/autoload.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST["id_user"];
    $confirm_password = $_POST["confirm-password"];
    $props = array(
        "newpass" => $_POST["newpass"],
        "fullname" => $_POST["fullname"],
        "gender" => $_POST["gender"],
        "birth" => $_POST["birth"],
        "address" => $_POST["address"]
    );
}
?>