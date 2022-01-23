<?php

require_once('../../model/CartPurchaseModel.php');

class CartPurchaseController {

    var $controller;

    public function __construct()
    {
        $this->controller = new CartPurchaseModel;
    }

    public function ViewController($username){
        return $this->controller->ViewPurchaseSale($username);
    }
    
    public function AddController($id_item, $username){
        return $this->controller->Add($id_item, $username);
    }

    public function DeleteController($id){
        return $this->controller->Delete($id);
    }
}