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
        $data = mysqli_query($this->server->mysql, "SELECT invoice.*, sale.*, items.*, sales.*, customer.* FROM invoice, sale, sales, items, customer WHERE invoice.id_sale = sale.id_selling_items
                            AND items.id_item = sale.id_items AND customer.id_customer = sale.id_customer AND sales.id_sales = sale.id_sales");
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

    public function Update($id_invoice, $username, $status_pay){
        
        $date = date('Y-m-d');

        $update_invoice = mysqli_query($this->server->mysql, "UPDATE invoice SET status_pay = '$status_pay', update_date = '$date', update_by = '$username' 
                  WHERE id_invoice = '$id_invoice'");

        if($update_invoice == false){
            return $this->msg->Error('Gagal untuk mengupdate invoice');
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