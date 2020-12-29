<?php
    require_once __DIR__ . "/../../autoload/autoload.php";
    if($_POST["values"]){
        $data = handleDataForm($_POST["values"]);
    }
?>