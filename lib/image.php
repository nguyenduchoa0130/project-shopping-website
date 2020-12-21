<?php
class ImageProduct{
    private $id_product;
    private $link;
    public function __construct(array $props)
    {
        $this->id_product = $props["id_product"];
        $this->link = $props["link_img"];
    }
    public function get_IdProduct(){
        return $this->id_product;
    }
    public function get_Link(){
        return $this->link;
    }
}
?>
