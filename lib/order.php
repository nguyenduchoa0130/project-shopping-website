<?php
class Order{
    public $id_order;
    public $id_user;
    public $status;
    public $date_created;
    public $date_delevery;
    public $date_completed;
    public $address_ship;
    public $ship_cash;
    public $sum_cash;
    public $note;
    public function __construct(array $prop)
    {
        $this->id_order = $prop["id_order"];
        $this->id_user = $prop["id_user"];
        $this->status = $prop["status"];
        $this->date_created = $prop["date_created"];
        $this->date_delevery = $prop["date_delevery"];
        $this->date_completed = $prop["date_completed"];
        $this->address_ship = $prop["address_ship"];
        $this->ship_cash = $prop["ship_cash"];
        $this->sum_cash = $prop["sum_cash"];
        $this->note = $prop["note"];
    }
}
?>