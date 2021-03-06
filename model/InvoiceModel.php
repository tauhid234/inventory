<?php 
require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class InvoiceModel{

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
    
    public function ViewSingleInvoice(){
        $data = mysqli_query($this->server->mysql, "SELECT invoice.*, customer.name_customer, customer.id_customer, sales.name_sales, sales.id_sales FROM invoice, sales, customer WHERE sales.id_sales = invoice.id_sales_invoice AND customer.id_customer = invoice.id_customer_invoice");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }
    
    public function ViewHutangInvoice(){
        $data = mysqli_query($this->server->mysql, "SELECT invoice.*, customer.name_customer, customer.id_customer, sales.name_sales, sales.id_sales FROM invoice, sales, customer WHERE sales.id_sales = invoice.id_sales_invoice AND customer.id_customer = invoice.id_customer_invoice 
                             AND invoice.status_pay = 'UNPAID' AND invoice.tempo_date IS NOT NULL");
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
        $data = mysqli_query($this->server->mysql, "SELECT * FROM invoice WHERE no_invoice = '$no_invoice' AND sale_versi_invoice = '$versi'");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function Add($username, $id_sale, $tempo, $status_pay){

        $no_invoice = time();


        $date = date('Y-m-d');

        $ids = $this->uid->guidv4();


        $insert = mysqli_query($this->server->mysql, "INSERT INTO invoice (id, id_invoice, no_invoice, id_sale, tempo_date, status_pay,
                            create_by, create_date, update_by, update_date) VALUES ('', '$ids', '$no_invoice', '$id_sale', '$tempo', 
                            '$status_pay', '$username', '$date', null, null)");
        
        if($insert == false){
            return $this->msg->Error("Gagal menambahkan invoice penjualan");
        }

        $update_sale = mysqli_query($this->server->mysql, "UPDATE sale SET no_invoice_sale = '$no_invoice', update_by = '$username', update_date = '$date' WHERE id_selling_items = '$id_sale'");

        if($update_sale == false){
            return $this->msg->Error("Gagal update no invoice di penjualan");
        }
        
        return $this->msg->Success('Data invoice berhasil disimpan');
    }
    
    public function AddInvoice($username, $versi_sale, $status_pay, $id_customer_invoice, $id_sales_invoice){

        $no_invoice = time();


        $date = date('Y-m-d');

        $ids = $this->uid->guidv4();

        $cek_duplicate = mysqli_query($this->server->mysql, "SELECT * FROM invoice WHERE sale_versi_invoice = '$versi_sale'");
        $num = mysqli_num_rows($cek_duplicate);
        if($num == 0){
            $insert = mysqli_query($this->server->mysql, "INSERT INTO invoice (id, id_invoice, no_invoice, tempo_date, status_pay, sale_versi_invoice,
                            id_customer_invoice, id_sales_invoice, create_by, create_date, update_by, update_date) VALUES ('', '$ids', '$versi_sale', null, 
                            '$status_pay', '$versi_sale', '$id_customer_invoice', '$id_sales_invoice', '$username', '$date', null, null)");
        
            if($insert == false){
                return $this->msg->Error("Gagal menambahkan invoice penjualan");
            }
        }

        

        $update_sale = mysqli_query($this->server->mysql, "UPDATE sale SET no_invoice_sale = '$versi_sale', update_by = '$username', update_date = '$date' WHERE sale_versi = '$versi_sale'");

        if($update_sale == false){
            return $this->msg->Error("Gagal update no invoice di penjualan");
        }
        
        return $this->msg->Success('Data invoice berhasil disimpan');
    }

    public function AddInvoiceV2($username, $status_pay, $id_customer_invoice, $id_sales_invoice, $sale_versi_invoice, $keterangan){

        // $no_invoice = time();
        $total = 0;


        if($id_customer_invoice == "" || $id_sales_invoice == ""){
            return $this->msg->Warning("Harap pilih nama pelanggan dan sales dahulu");
        }

        $date = date('Y-m-d');

        $ids = $this->uid->guidv4();

        $get_data_invoice = mysqli_query($this->server->mysql, "SELECT COUNT(id_sales_invoice) AS total FROM invoice WHERE id_sales_invoice = '$id_sales_invoice'");
        $data = mysqli_fetch_assoc($get_data_invoice);
        if($get_data_invoice == false){
            return $this->msg->Error("Gagal mengambil data nomor invoice count sales");
        }

        if($data['total'] == 0){
           $total =  1;
        }else{
           $total = (int)$data['total'] + 1;
        }

        $sum = '00'.(string)$total;
        $no_invoice = sprintf("%03d", $sum);

        $cek_duplicate = mysqli_query($this->server->mysql, "SELECT * FROM invoice WHERE sale_versi_invoice = '$sale_versi_invoice'");
        $rows = mysqli_num_rows($cek_duplicate);

        if($rows == 0){

            $insert = mysqli_query($this->server->mysql, "INSERT INTO invoice (id, id_invoice, no_invoice, tempo_date, status_pay, keterangan, sale_invoice, sale_versi_invoice,
                            id_customer_invoice, id_sales_invoice, create_by, create_date, update_by, update_date) VALUES ('', '$ids', '$no_invoice', null, 
                            '$status_pay', '$keterangan', '$no_invoice', '$sale_versi_invoice', '$id_customer_invoice', '$id_sales_invoice', '$username', '$date', null, null)");
        
            if($insert == false){
                return $this->msg->Error("Gagal menambahkan invoice penjualan");
            }
        
            return $this->msg->Success('Data invoice berhasil disimpan');

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
    
    public function UpdateTempoInvoice($versi, $username, $tempo){
        
        $date = date('Y-m-d');

        $update_invoice = mysqli_query($this->server->mysql, "UPDATE invoice SET tempo_date = '$tempo', update_date = '$date', update_by = '$username' 
                  WHERE sale_versi_invoice = '$versi'");

        if($update_invoice == false){
            return $this->msg->Error('Gagal untuk mengupdate invoice');
        }

        return $this->msg->Success('Tanggal tempo invoice berhasil di simpan');
    }
    
    public function UpdatePembayaranInvoice($no_invoice, $username, $status_pay, $keterangan, $versioning){
        
        $date = date('Y-m-d');

        $update_invoice = mysqli_query($this->server->mysql, "UPDATE invoice SET status_pay = '$status_pay', keterangan = '$keterangan', update_date = '$date', update_by = '$username' 
                  WHERE no_invoice = '$no_invoice' AND sale_versi_invoice = '$versioning'");

        if($update_invoice == false){
            return $this->msg->Error('Gagal untuk mengupdate invoice');
        }

        // UPDATE SALE KETERANGAN
        $update_sale = mysqli_query($this->server->mysql, "UPDATE sale SET keterangan = '$keterangan', update_date = '$date', update_by = '$username' 
                  WHERE no_invoice_sale = '$no_invoice' AND sale_versi = '$versioning'");

        if($update_sale == false){
            return $this->msg->Error('Gagal untuk mengupdate penjualan');
        }

        return $this->msg->Success('Data invoice berhasil di update');
    }

    public function Delete($id_invoice){

        $delete = mysqli_query($this->server->mysql, "DELETE FROM invoice WHERE id_invoice = '$id_invoice'");

        if($delete == false){
            return $this->msg->Error($delete);
        }

        return $this->msg->Success('Data invoice berhasil dihapus');
    }
}