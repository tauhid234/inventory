<?php

require_once('../../model/RaftsModel.php');

class RaftsController {

    var $controller;

    public function __construct()
    {
        $this->controller = new RaftsModel;
    }

    public function ViewController(){
        return $this->controller->View();
    }
    
    public function ViewIdController($id){
        return $this->controller->ViewId($id);
    }

    public function AddController($username, $name_item, $size, $size_type, $quantity, $unit_type){
        return $this->controller->Add($username, $name_item, $size, $size_type, $quantity, $unit_type);
    }

    public function UpdateController($id, $name_item, $username, $quantity, $status){
        return $this->controller->Update($id, $name_item, $username, $quantity, $status);
    }

    public function DeleteController($id){
        return $this->controller->Delete($id);
    }
}