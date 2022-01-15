<?php

require_once('../../model/ReturModel.php');
require_once('../../util/MessageUtil.php');

class ReturController {

    var $controller;
    var $msg;
    var $profit;

    public function __construct()
    {
        $this->controller = new ReturModel;
        $this->msg = new MessageUtil();
    }

    public function ViewController(){
        return $this->controller->View();
    }

    public function AddController($id_sale, $id_sales, $id_customer, $retur_amount, $username, $versi_sale, $sale_invoice, $potongan){

        return $this->controller->AddRetur($id_sale, $id_sales, $id_customer, $retur_amount, $username, $versi_sale, $sale_invoice, $potongan);
    }

}