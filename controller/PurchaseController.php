<?php 

require_once('../../model/PurchaseModel.php');
require_once('../../util/MessageUtil.php');

class PurchaseController{

    var $model;

    public function __construct()
    {
        $this->model = new PurchaseModel;    
    }

    public function AddController($id_suplier, $no_invoice, $tgl_beli, $status_pay, $id_items, $nama_barang, $ukuran, $jenis_ukuran, $jenis_satuan, $harga_beli, $harga_jual, $jumlah_beli, $total_harga, $username, $purchase_versi){
        return $this->model->Add($id_suplier, $no_invoice, $tgl_beli, $status_pay, $id_items, $nama_barang, $ukuran, $jenis_ukuran, $jenis_satuan, $harga_beli, $harga_jual, $jumlah_beli, $total_harga, $username, $purchase_versi);
    }

    public function UpdatePaymentStatus($id_purchase, $status_pay, $username){
        return $this->model->UpdateStatusPayment($id_purchase, $status_pay, $username);
    }
}