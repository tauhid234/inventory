<?php

require_once('../../model/CartSaleModel.php');

class CartSaleController {

    var $controller;

    public function __construct()
    {
        $this->controller = new CartSaleModel;
    }

    public function ViewController($username){
        return $this->controller->ViewCartSale($username);
    }
    
    public function AddController($id_item, $username){
        return $this->controller->Add($id_item, $username);
    }

    public function DeleteController($id){
        return $this->controller->Delete($id);
    }
}