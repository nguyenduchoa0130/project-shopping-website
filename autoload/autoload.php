<?php
    header ('Content-Type: text/html; charset=UTF-8'); 
    require_once __DIR__. "/../lib/database.php";
    require_once __DIR__. "/../lib/function.php";
    require_once __DIR__. "/../lib/category.php";
    require_once __DIR__. "/../lib/product.php";
    require_once __DIR__. "/../lib/image.php";
    require_once __DIR__. "/../lib/order.php";
    require_once __DIR__. "/../lib/account.php";
    require_once __DIR__. "/../lib/notification.php";
    require_once __DIR__. "/../public/user/vendor/autoload.php";
    define("ROOT", "/project-shopping-website");
    session_start();
    $database = new Database("localhost", "db_shopping", "root", "");
    /**
     * @param 1: Thành công, 0: Lỗi
     */
?>