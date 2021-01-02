<?php
    require_once __DIR__ . "/../../autoload/autoload.php";
    if(isset($_POST["req"])){
        $currentUser = $database->getCurrentUser();
        if($currentUser){
            echo json_encode($currentUser);
        }else{
            echo '';
        }
    }
?>