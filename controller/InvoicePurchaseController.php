<?php

require_once('../../model/InvoicePembelianModel.php');
require_once('../../util/MessageUtil.php');

class InvoicePurchaseController {

    var $controller;
    var $msg;
    var $profit;

    public function __construct()
    {
        $this->controller = new InvoicePembelianModel();
        $this->msg = new MessageUtil();
    }

    public function ViewController(){
        return $this->controller->View();
    }

    public function AddInvoiceControllerPurchase($username, $no_invoice_purchase, $status_pay, $id_suplier_invoice, $purchase_versi_invoice, $keterangan){

        return $this->controller->AddInvoicePurchase($username, $no_invoice_purchase, $status_pay, $id_suplier_invoice, $purchase_versi_invoice, $keterangan);
    }

    public function UpdateController($id_invoice, $username, $status_bayar){
        return $this->controller->Update($id_invoice, $username, $status_bayar);
    }
    
    public function UpdatePembayaranController($no_invoice, $username, $status_pay, $keterangan, $versioning){
        return $this->controller->UpdatePembayaranInvoicePurchase($no_invoice, $username, $status_pay, $keterangan, $versioning);
    }

}