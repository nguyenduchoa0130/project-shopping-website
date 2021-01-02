<?php
    require_once __DIR__ . "/../../autoload/autoload.php";
    unset($_SESSION["username"]);
    header("Location: ../../index.php");
?>