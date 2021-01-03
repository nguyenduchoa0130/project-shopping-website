<?php
class ImageProduct{
   public $id_img;
   public $name;
   public $image;
   public $number_order;
   public $id_product;
   public function __construct(array $prop)
   {
     $this->id_img = $prop["id_img"];
     $this->name = $prop["name"];
     $this->image = $prop["image"];
     $this->number_order = $prop["number_order"];
     $this->id_product = $prop["id_product"];
   }
}
?>
