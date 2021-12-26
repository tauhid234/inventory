<?php

require_once('../../model/SalesModel.php');

class SalesController {

    var $controller;

    public function __construct()
    {
        $this->controller = new SalesModel();
    }

    public function ViewController(){
        return $this->controller->View();
    }

    public function AddController($username, $name_sales, $nohp, $email, $kota, $kode_pos, $alamat){
        return $this->controller->Add($username, $name_sales, $nohp, $email, $kota, $kode_pos, $alamat);
    }

    public function UpdateController($id, $username, $name_sales, $nohp, $email, $kota, $kode_pos, $alamat){
        return $this->controller->Update($id, $username, $name_sales, $nohp, $email, $kota, $kode_pos, $alamat);
    }

    public function DeleteController($id){
        return $this->controller->Delete($id);
    }
}