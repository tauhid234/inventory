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
    
    public function AddInvoiceController($username, $versi_sale, $customer_invoice, $sales_invoice){

        return $this->controller->AddInvoice($username, $versi_sale, 'UNPAID', $customer_invoice, $sales_invoice);
    }

    public function UpdateController($id_invoice, $username, $status_bayar){
        return $this->controller->Update($id_invoice, $username, $status_bayar);
    }
    
    public function UpdateTempoController($no_invoice, $username, $tempo){
        return $this->controller->UpdateTempoInvoice($no_invoice, $username, $tempo);
    }
    
    public function UpdatePembayaranController($no_invoice, $username, $status_pay){
        return $this->controller->UpdatePembayaranInvoice($no_invoice, $username, $status_pay);
    }

}