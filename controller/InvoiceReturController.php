<?php

require_once('../../model/InvoiceReturModel.php');
require_once('../../util/MessageUtil.php');

class InvoiceReturController {

    var $controller;
    var $msg;
    var $profit;

    public function __construct()
    {
        $this->controller = new InvoiceReturModel;
        $this->msg = new MessageUtil();
    }

    public function ViewController(){
        return $this->controller->View();
    }

    public function AddInvoiceReturController($username, $customer_invoice, $sales_invoice, $sale_invoice_retur){

        return $this->controller->AddInvoiceRetur($username, $customer_invoice, $sales_invoice, $sale_invoice_retur);
    }

}