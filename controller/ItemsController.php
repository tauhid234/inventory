<?php

require_once('../../model/ItemsModel.php');

class ItemsController {

    var $controller;

    public function __construct()
    {
        $this->controller = new ItemsModel();
    }

    public function ViewController(){
        return $this->controller->View();
    }
    
    public function ViewIdController($id){
        return $this->controller->ViewId($id);
    }

    public function AddController($username, $name_item, $size, $size_type, $quantity, $unit_type, $purchase_price, $selling_price){
        return $this->controller->Add($username, $name_item, $size, $size_type, $quantity, $unit_type, $purchase_price, $selling_price);
    }

    public function UpdateController($id, $username, $name_item, $size, $size_type, $quantity, $unit_type, $purchase_price, $selling_price){
        return $this->controller->Update($id, $username, $name_item, $size, $size_type, $quantity, $unit_type, $purchase_price, $selling_price);
    }

    public function DeleteController($id){
        return $this->controller->Delete($id);
    }
}