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

    public function AddController($id_items, $value, $id_customer, $id_sales, $selling_amount, $selling_price_sales, $selling_price_admin, $total_amount, $price_clean, $username){

        if($value < 0){
            return $this->msg->Warning("Jumlah penjualan barang tidak boleh melebihi kapasitas stock saat ini");
        }

        if($selling_price_sales < $selling_price_admin){
            return $this->msg->Warning("Harga jual sales harus lebih tinggi daripada harga jual admin");
        }

        // $t = $price_clean + $total_amount;
        $this->profit = $price_clean / 100 * 30;
        return $this->controller->Add($id_items, $value, $this->profit, $id_customer, $id_sales, $selling_amount, $selling_price_sales, $total_amount, $price_clean, $username);
    }
    
    public function AddPenjualanController($id_items, $value, $id_customer, $id_sales, $selling_amount, $selling_price_sales, $selling_price_admin, $sale_versi, $total_amount, $price_clean, $username){

        if($value < 0){
            return $this->msg->Warning("Jumlah penjualan barang tidak boleh melebihi kapasitas stock saat ini");
        }

        if($selling_price_sales < $selling_price_admin){
            return $this->msg->Warning("Harga jual sales harus lebih tinggi daripada harga jual admin");
        }

        // $t = $price_clean + $total_amount;
        $this->profit = $price_clean / 100 * 30;
        return $this->controller->AddPenjualan($id_items, $value, $this->profit, $id_customer, $id_sales, $selling_amount, $selling_price_sales, $sale_versi, $total_amount, $price_clean, $username);
    }

    public function AddPenjualanControllerV2($id_items, $value, $id_customer, $id_sales, $selling_amount, $selling_price_sales, $selling_price_admin, $sale_versi, $total_amount, $price_clean, $username, $keterangan){

        if($value < 0){
            return $this->msg->Warning("Jumlah penjualan barang tidak boleh melebihi kapasitas stock saat ini");
        }

        if($selling_price_sales < $selling_price_admin){
            return $this->msg->Warning("Harga jual sales harus lebih tinggi daripada harga jual admin");
        }

        // $t = $price_clean + $total_amount;
        $this->profit = $price_clean;
        return $this->controller->AddPenjualanV2($id_items, $value, $this->profit, $id_customer, $id_sales, $selling_amount, $selling_price_sales, $sale_versi, $total_amount, $price_clean, $username, $keterangan);
    }

}