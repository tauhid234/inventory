<?php

require_once('../../model/InvoiceModel.php');
require_once('../../util/MessageUtil.php');

class InvoiceController {

    var $controller;
    var $msg;
    var $profit;

    public function __construct()
    {
        $this->controller = new InvoiceModel();
        $this->msg = new MessageUtil();
    }

    public function ViewController(){
        return $this->controller->View();
    }

    public function AddController($username, $id_sale, $tempo, $status_pay){

        return $this->controller->Add($username, $id_sale, $tempo, $status_pay);
    }

    public function UpdateController($id_invoice, $username, $status_bayar){
        return $this->controller->Update($id_invoice, $username, $status_bayar);
    }

}