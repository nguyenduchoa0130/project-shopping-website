<?php
class Category{
    private $id_category;
    private $name_category;
    private $icon_category;
    public function __construct(array $props)
    {
        $this->id_category = $props["id_category"];
        $this->name_category = $props["name_category"];
        $this->icon_category = $props["icon_category"];
    }
    public function get_IdCategory(){
        return $this->id_category;
    }
    public function get_NameCategory(){
        return $this->name_category;
    }
    public function get_ImgCategory(){
        return $this->icon_category;
    }
    public function set_IdCategory($id){
        $this->id_category = $id;
    }
    public function set_NameCategory($name){
       $this->name_category = $name;
    }

    public function set_ImgCategory($classFontAwesome){
        $this->icon_category = $classFontAwesome;
    }  
}
