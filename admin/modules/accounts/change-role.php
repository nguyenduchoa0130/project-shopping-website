<?php

use function PHPSTORM_META\type;

require_once __DIR__. "/../../../autoload/autoload.php";
    if(isset($_POST["username"]) && isset($_POST["code"])){
        $username = $_POST["username"];
        $code = $_POST["code"];
        try{
            $data = $database->findAccountByUsername($username);
            if($code == 1){
                if($data["role"] == 0){
                    $str = "";
                    $str .= "<option value='0' selected>Quản trị viên</option>";
                    $str .= "<option value='1'>Khách hàng</option>";
                }else{
                    $str = "";
                    $str .= "<option value='0'>Quản trị viên</option>";
                    $str .= "<option value='1' selected>Khách hàng</option>";
                }
                echo $str;
            }else{
                $data["role"] = (int)$_POST["role"];
                $sql = "UPDATE `tbl_account` SET `role` = {$data['role']} WHERE `username` = '{$username}'";
                $database->executeNonQuery($sql);
                echo "<p class='h3 m-0 text-success font-weight-bole'><i class='fas fa-check'></i> Thay Đổi Thành Công</p>";
            }
        }catch(PDOException $e){
            echo "Có lỗi xảy ra với database ". $e->getMessage();
        }
    }
?>
