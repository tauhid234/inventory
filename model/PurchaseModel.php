<?php 

require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class PurchaseModel{

    var $server;
    var $output = [];
    var $msg;

    var $uid;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->server = new Server();
        $this->msg = new MessageUtil();
        $this->uid = new UUID();
    }

    public function View(){
        $data = mysqli_query($this->server->mysql, "SELECT suplier.*, purchase.* FROM purchase, suplier WHERE purchase.id_suplier = suplier.id_suplier");
        while($d = mysqli_fetch_assoc($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }
    
    public function ViewHutangSuplier(){
        $data = mysqli_query($this->server->mysql, "SELECT suplier.*, purchase.* FROM purchase, suplier WHERE purchase.id_suplier = suplier.id_suplier AND purchase.status_pay = 'UNPAID'");
        while($d = mysqli_fetch_assoc($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function Add($id_suplier, $no_invoice, $tgl_beli, $status_pay, $id_items, $nama_barang, $ukuran, $jenis_ukuran, $jenis_satuan, $harga_beli, $harga_jual, $jumlah_beli, $total_harga, $username){
        
        $date = date('Y-m-d');

        $ids = $this->uid->guidv4();

        if($id_suplier == "" || $status_pay == ""){
            return $this->msg->Warning("Harap pilih nama suplier dan status bayar dahulu");
        }

        if($tgl_beli == ""){
            return $this->msg->Warning("Harap pilih tanggal pembelian dahulu");
        }

        $name_items = strtoupper($nama_barang);
        $jenis_satuans = strtoupper($jenis_satuan);
        $jenis_ukurans = strtoupper($jenis_ukuran);


        $insert = mysqli_query($this->server->mysql, "INSERT INTO purchase (id, id_purchase, id_suplier, purchase_date, purchase_amount, total_amount, no_invoice_purchase, status_pay, 
                              name_items_purchase, size_purchase, size_type, unit_type, purchase_price, create_date, create_by, update_date, update_by) VALUES 
                             ('', '$ids', '$id_suplier', '$tgl_beli', '$jumlah_beli', '$total_harga', '$no_invoice', '$status_pay', '$name_items', '$ukuran', '$jenis_ukurans', '$jenis_satuans',
                             '$harga_beli', '$date', '$username', null, null)");
        
        if($insert == false){
            return $this->msg->Error("Gagal menambahkan pembelian baru ".$insert);
        }


        $get_items = mysqli_query($this->server->mysql, "SELECT quantity FROM items WHERE id_item = '$id_items'");
        $num = mysqli_num_rows($get_items);
        $array = mysqli_fetch_array($get_items);

        if($num == 1){
            $sum = $array['quantity'] + $jumlah_beli; 
            $update_item = mysqli_query($this->server->mysql, "UPDATE items SET quantity = '$sum', purchase_price = '$harga_beli', selling_price = '$harga_jual', update_by = '$username', update_date = '$date' WHERE id_item = '$id_items'");
            if($update_item == false){
                return $this->msg->Error("Gagal Update items di pembelian");
            }
        }

        // DELETE CART
        $delete = mysqli_query($this->server->mysql, "DELETE FROM cart_purchase WHERE id_cart = '$id_items' AND session_cart = '$username'");
        if($delete == false){
            return $this->msg->Error("Gagal hapus session data penjualan");
        }

        return $this->msg->Success('Data pembelian berhasil disimpan');
    }

    public function UpdateStatusPayment($id_purcahse, $status_pay, $username){

        $date = date('Y-m-d');

        $update = mysqli_query($this->server->mysql, "UPDATE purchase SET status_pay = '$status_pay', update_date = '$date', update_by = '$username' WHERE id_purchase = '$id_purcahse'");

        if($update == false){
            return $this->msg->Error("Gagal mengupdate pembayaran pembelian");
        }

        return $this->msg->Success("Data pembayaran pada pembelian berhasil terbayarkan");
    }

    public function ViewRangeDate($tgl_mulai, $tgl_akhir){
        $data = mysqli_query($this->server->mysql, "SELECT purchase.*, suplier.* FROM purchase, suplier WHERE purchase.id_suplier = suplier.id_suplier AND purchase.purchase_date >= '$tgl_mulai' AND purchase.purchase_date <= '$tgl_akhir'");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function ViewTransaksiAll(){
        $all = mysqli_query($this->server->mysql, "SELECT SUM(total_amount) AS total_pembelian FROM purchase");
        $data = mysqli_fetch_array($all);
        return $data['total_pembelian'];
    }

    public function ViewTransaksiRange($tgl_mulai, $tgl_akhir){
        $all = mysqli_query($this->server->mysql, "SELECT SUM(total_amount) AS total_pembelian FROM purchase WHERE purchase_date >= '$tgl_mulai' AND purchase_date <= '$tgl_akhir'");
        $data = mysqli_fetch_array($all);
        return $data['total_pembelian'];
    }
}