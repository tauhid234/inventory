<?php 
require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class InvoicePembelianModel{

    var $output = [];
    var $msg;
    var $server;
    var $uid;

    public function __construct()
    {
        $this->server = new Server();
        $this->msg = new MessageUtil();
        $this->uid = new UUID();
    }

    public function View(){
        $data = mysqli_query($this->server->mysql, "SELECT invoice.*, sale.*, items.*, sales.*, customer.* FROM invoice, sale, sales, items, customer WHERE invoice.sale_versi_invoice = sale.sale_versi
                            AND items.id_item = sale.id_items AND customer.id_customer = sale.id_customer AND sales.id_sales = sale.id_sales");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function ViewPurchaseInvoiceProduct($no_invoice, $versi){
        $data = mysqli_query($this->server->mysql, "SELECT items.name_item,
                             suplier.name_suplier, suplier.id_suplier,
                             purchase.id_suplier, purchase.create_date, purchase.purchase_versi, purchase.name_items_purchase, purchase.purchase_amount, purchase.total_amount, purchase.purchase_price, purchase.no_invoice_purchase,
                             invoice_purchase.purchase_versi_invoice, invoice_purchase.status_pay
                             FROM items,suplier,purchase,invoice_purchase WHERE purchase.purchase_versi = '$versi' AND items.name_item = purchase.name_items_purchase AND invoice_purchase.purchase_versi_invoice = '$versi'
                             AND suplier.id_suplier = purchase.id_suplier");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        array_shift($this->output);
        return $this->output;
        mysqli_close($this->server->mysql);
    }
    
    public function ViewSingleInvoice(){
        $data = mysqli_query($this->server->mysql, "SELECT invoice_purchase.*, suplier.name_suplier, suplier.id_suplier FROM invoice_purchase, suplier WHERE suplier.id_suplier = invoice_purchase.id_suplier_invoice");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function ViewId($id){
        $data = mysqli_query($this->server->mysql, "SELECT invoice.*, sale.*, items.*, sales.*, customer.* FROM invoice, sale, sales, items, customer WHERE invoice.id_invoice = '$id' AND invoice.id_sale = sale.id_selling_items
                            AND items.id_item = sale.id_items AND customer.id_customer = sale.id_customer AND sales.id_sales = sale.id_sales");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function ViewNoInvoice($no_invoice, $versi){
        $data = mysqli_query($this->server->mysql, "SELECT * FROM invoice_purchase WHERE no_invoice_purchase = '$no_invoice' AND purchase_versi_invoice = '$versi'");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function AddInvoicePurchase($username, $no_invoice_purchase, $status_pay, $id_suplier_invoice, $purchase_versi_invoice, $keterangan){

        // $no_invoice = time();
        $total = 0;


        if($id_suplier_invoice == ""){
            return $this->msg->Warning("Harap pilih nama suplier dahulu");
        }

        $date = date('Y-m-d');

        $ids = $this->uid->guidv4();

        // $get_data_invoice = mysqli_query($this->server->mysql, "SELECT COUNT(id_suplier_invoice) AS total FROM invoice_purchase WHERE id_suplier_invoice = '$id_suplier_invoice'");
        // $data = mysqli_fetch_assoc($get_data_invoice);
        // if($get_data_invoice == false){
        //     return $this->msg->Error("Gagal mengambil data nomor invoice count suplier");
        // }

        // if($data['total'] == 0){
        //    $total =  1;
        // }else{
        //    $total = (int)$data['total'] + 1;
        // }

        // $sum = '00'.(string)$total;
        // $no_invoice = sprintf("%03d", $sum);

        $cek_duplicate = mysqli_query($this->server->mysql, "SELECT * FROM invoice_purchase WHERE purchase_versi_invoice = '$purchase_versi_invoice' AND no_invoice_purchase = '$no_invoice_purchase' AND id_suplier_invoice = '$id_suplier_invoice'");
        $rows = mysqli_num_rows($cek_duplicate);

        if($rows == 0){

            $insert = mysqli_query($this->server->mysql, "INSERT INTO invoice_purchase (id, id_invoice_purchase, no_invoice_purchase, status_pay, keterangan_purchase, purchase_invoice, purchase_versi_invoice,
                            id_suplier_invoice, create_by, create_date, update_by, update_date) VALUES ('', '$ids', '$no_invoice_purchase',
                            '$status_pay', '$keterangan', '$no_invoice_purchase', '$purchase_versi_invoice', '$id_suplier_invoice', '$username', '$date', null, null)");
        
            if($insert == false){
                return $this->msg->Error("Gagal menambahkan invoice pembelian");
            }
        
            return $this->msg->Success('Data invoice pembelian berhasil disimpan');

        }

            
    }

    public function Update($id_invoice, $username, $status_pay){
        
        $date = date('Y-m-d');

        $update_invoice = mysqli_query($this->server->mysql, "UPDATE invoice SET status_pay = '$status_pay', update_date = '$date', update_by = '$username' 
                  WHERE id_invoice = '$id_invoice'");

        if($update_invoice == false){
            return $this->msg->Error('Gagal untuk mengupdate invoice');
        }

        return $this->msg->Success('Data invoice berhasil di update');
    }
    
    public function UpdatePembayaranInvoicePurchase($no_invoice, $username, $status_pay, $keterangan, $versioning){
        
        $date = date('Y-m-d');

        $update_invoice = mysqli_query($this->server->mysql, "UPDATE invoice_purchase SET status_pay = '$status_pay', keterangan_purchase = '$keterangan', update_date = '$date', update_by = '$username' 
                  WHERE no_invoice_purchase = '$no_invoice' AND purchase_versi_invoice = '$versioning'");

        $update_purchase = mysqli_query($this->server->mysql, "UPDATE purchase SET status_pay = '$status_pay', update_date = '$date', update_by = '$username' 
                  WHERE no_invoice_purchase = '$no_invoice' AND purchase_versi = '$versioning'");

        $test = $no_invoice.",".$status_pay.",".$keterangan.",".$versioning;
        // var_dump($test);

        if($update_invoice == false){
            return $this->msg->Error('Gagal untuk mengupdate invoice pembelian');
        }

        if($update_purchase == false){
            return $this->msg->Error('Gagal untuk mengupdate pembelian');
        }

        return $this->msg->Success('Data invoice berhasil di update');
    }
}