<?php
    class CartDetail{
        public $id_cart_detail;
        public $id_cart;
        public $id_product;
        public $quantity;
        public $price;
        public function __construct($props)
        {
            $this->id_cart_detail = $props["id_cart_detail"];
            $this->id_cart = $props["id_cart"];
            $this->id_product = $props["id_product"];
            $this->quantity = $props["quantity"];
            $this->price = $props["price"];
        }
    }
?>