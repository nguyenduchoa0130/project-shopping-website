<?php
    class Cart{
        public $id_cart; 
        public $id_user;
        public function __construct($props)
        {
            $this->id_cart = $props["id_cart"];
            $this->id_user = $props["id_user"];
        }
    }
?>