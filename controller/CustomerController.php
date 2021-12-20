<?php

require_once('../../model/CustomerModel.php');

class CustomerController {

    var $controller;

    public function __construct()
    {
        $this->controller = new CustomerModel();
    }

    public function ViewController(){
        return $this->controller->View();
    }

    public function AddController($username, $name_customer, $nohp, $email, $kota, $kode_pos, $alamat){
        return $this->controller->Add($username, $name_customer, $nohp, $email, $kota, $kode_pos, $alamat);
    }

    public function UpdateController($id, $username, $name_customer, $nohp, $email, $kota, $kode_pos, $alamat){
        return $this->controller->Update($id, $username, $name_customer, $nohp, $email, $kota, $kode_pos, $alamat);
    }

    public function DeleteController($id){
        return $this->controller->Delete($id);
    }
}