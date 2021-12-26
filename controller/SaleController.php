<?php

require_once('../../model/SaleModel.php');
require_once('../../util/MessageUtil.php');

class SaleController {

    var $controller;
    var $msg;
    var $profit;

    public function __construct()
    {
        $this->controller = new SaleModel();
        $this->msg = new MessageUtil();
    }

    public function ViewController(){
        return $this->controller->View();
    }
    
    public function ViewIdController($id_sell){
        return $this->controller->ViewId($id_sell);
    }

    public function AddController($id_items, $value, $id_customer, $id_sales, $selling_amount, $total_amount, $price_clean, $username){

        if($value < 0){
            return $this->msg->Warning("Jumlah penjualan barang tidak boleh melebihi kapasitas stock saat ini");
        }

        $t = $price_clean + $total_amount;
        $this->profit = $t / 100 * 30;
        return $this->controller->Add($id_items, $value, $this->profit, $id_customer, $id_sales, $selling_amount, $total_amount, $price_clean, $username);
    }

}