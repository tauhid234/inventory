<?php

require_once('../../model/UnitModel.php');

class UnitController {

    var $controller;

    public function __construct()
    {
        $this->controller = new UnitModel();
    }

    public function ViewController(){
        return $this->controller->View();
    }

    public function AddController($nama_size){
        return $this->controller->Add($nama_size);
    }
}