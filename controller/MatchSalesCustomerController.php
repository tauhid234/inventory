<?php

require_once('../../model/MatchSalesCustomerModel.php');

class MatchSalesCustomerController {

    var $controller;

    public function __construct()
    {
        $this->controller = new MatchSalesCustomerModel();
    }

    public function ViewController(){
        return $this->controller->View();
    }

    public function ViewIdController($id){
        return $this->controller->ViewId($id);
    }

    public function ViewIdMatchCustomerController($id_sales){
        return $this->controller->ViewIdCustomerMatch($id_sales);
    }

    public function AddController($username, $id_customer, $id_sales){
        return $this->controller->Add($username, $id_customer, $id_sales);
    }

    public function UpdateController($id, $username, $id_customer, $id_sales){
        return $this->controller->Update($id, $username, $id_customer, $id_sales);
    }

    public function DeleteController($id){
        return $this->controller->Delete($id);
    }
}