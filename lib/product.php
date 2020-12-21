<?php
class Product{
    private $id_product;
    private $name_product;
    private $price = 0;
    private $quantity = 0;
    private $status = true;
    private $produced_at;
    private $description;
    private $id_category;
    public function __construct(array $props)
    {
       $this->id_product = $props["id_product"];
       $this->name_product = $props["name_product"];
       $this->price = $props["price"];
       $this->quantity = $props["quantity"];
       $this->status = $props["status"];
       $this->produced_at = $props["produced_at"];
       $this->description = $props["description"];
       $this->id_category = $props["id_category"];
    }
    public function get_IdProduct(){
        return $this->id_product;
    }
    public function get_NameProduct(){
        return $this->name_product;
    }
    public function get_Price(){
        return $this->price;
    }
    public function get_Quantity(){
        return $this->quantity;
    }
    public function get_Status(){
        return $this->status;
    }
    public function get_ProducedAt(){
        return $this->produced_at;
    }
    public function get_Description(){
        return $this->description;
    }
    public function get_IdCategory(){
        return $this->id_category;
    }
}
