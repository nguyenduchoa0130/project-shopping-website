<?php
class Product{
    public $id_product;
    public $name_product;
    public $price = 0;
    public $quantity = 0;
    public $status = true;
    public $number_liked = 0;
    public $star = 0;
    public $produced_at;
    public $description;
    public $id_category;    
    public function __construct(array $props)
    {
       $this->id_product = $props["id_product"];
       $this->name_product = $props["name_product"];
       $this->price = $props["price"];
       $this->quantity = $props["quantity"];
       $this->status = $props["status"];
       $this->number_liked = $props["number_liked"];
       $this->star = $props["star"];
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
