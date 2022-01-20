<?php

require_once('../../model/SizeModel.php');

class SizeController {

    var $controller;

    public function __construct()
    {
        $this->controller = new SizeModel();
    }

    public function ViewController(){
        return $this->controller->View();
    }

    public function AddController($nama_size){
        return $this->controller->Add($nama_size);
    }
}