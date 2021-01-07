<?php
require_once __DIR__ . "/../../autoload/autoload.php";
if (isset($_POST["id_user"]) && isset($_POST["id_product"]) && isset($_POST["quantity"])) {
    $id_user = (int)$_POST["id_user"];
    $id_product = (int)$_POST["id_product"];
    $quantity = (int)$_POST["quantity"];
    $noti = null;
    try {
        $cart = $database->getCart($id_user);
        if ($cart) {
            $cart = new Cart($cart);
            $cart_detail = $database->getCartDetail($cart->id_cart, $id_product);
            if ($cart_detail) {
                $cart_detail["quantity"] = $cart_detail["quantity"] + $quantity;
                $price = $database->getPriceProduct($id_product);
                $props = array(
                    "quantity" => $cart_detail["quantity"],
                    "price" => $price
                );
                $database->update("tbl_cart_detail", "id_cart_detail", $cart_detail["id_cart_detail"], $props);
                $noti = new Notification(C_UPDATE, "Đã cập nhật giỏ hàng");
            } else {
                $price = $database->getPriceProduct($id_product);
                $props = array(
                    "id_cart" => $cart->id_cart,
                    "id_product" => $id_product,
                    "quantity" => $quantity,
                    "price" => $price
                );
                $database->insert("tbl_cart_detail", $props);
                $noti = new Notification(C_ADD, "Đã thêm vào giỏ hàng");
            }
        } else {
            // thêm mới
            $id_cart = $database->insert("tbl_cart", array("id_user" => $id_user));
            $price = $database->getPriceProduct($id_product);
            $props = array(
                "id_cart" => $id_cart,
                "id_product" => $id_product,
                "quantity" => $quantity,
                "price" => $price
            );
            $database->insert("tbl_cart_detail", $props);
            $noti = new Notification(C_ADD, "Đã thêm vào giỏ hàng");
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
