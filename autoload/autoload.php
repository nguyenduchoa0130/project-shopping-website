<?php
    header ('Content-Type: text/html; charset=UTF-8'); 
    require_once __DIR__. "/../lib/database.php";
    require_once __DIR__. "/../lib/function.php";
    require_once __DIR__. "/../lib/category.php";
    require_once __DIR__. "/../lib/product.php";
    require_once __DIR__. "/../lib/image.php";
    require_once __DIR__. "/../lib/order.php";
    session_start();
    $database = new Database();
    $_SESSION["username"] = null;
?>