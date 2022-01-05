<?php 

require_once('../../model/PurchaseModel.php');
require_once('../../util/MessageUtil.php');

class PurchaseController{

    var $model;

    public function __construct()
    {
        $this->model = new PurchaseModel;    
    }

    public function AddController($id_suplier, $no_invoice, $tgl_beli, $status_pay, $nama_barang, $ukuran, $jenis_ukuran, $jenis_satuan, $harga_beli, $jumlah_beli, $total_harga, $username){
        return $this->model->Add($id_suplier, $no_invoice, $tgl_beli, $status_pay, $nama_barang, $ukuran, $jenis_ukuran, $jenis_satuan, $harga_beli, $jumlah_beli, $total_harga, $username);
    }

    public function UpdatePaymentStatus($id_purchase, $status_pay, $username){
        return $this->model->UpdateStatusPayment($id_purchase, $status_pay, $username);
    }
}