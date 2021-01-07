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
    require_once __DIR__. "/../lib/cart.php";
    require_once __DIR__. "/../lib/cart-detail.php";
    require_once __DIR__. "/../public/user/vendor/autoload.php";
    define("ROOT", "/project-shopping-website");
    
    define("C_ERROR", 0);
    define("C_SUCCESS", 1);
    define("C_ADD", 2);
    define("C_DELETE", 3);
    define("C_UPDATE", 4);
    define("C_VERIFYING", 0);
    define("C_SHIPPING", 1);
    define("C_DELIVERED", 2);
    define("C_CANCELLED", 3);
    
    session_start();
    $database = new Database("localhost", "happyshopping", "root", "");
    /**
     * @param 1: Thành công, 0: Lỗi
     */
?>