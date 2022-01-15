<?php 
require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class InvoiceReturModel{

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
        $data = mysqli_query($this->server->mysql, "SELECT invoice_retur.*, sale.*, items.*, sales.*, customer.* FROM invoice_retur, sale, sales, items, customer WHERE invoice_retur.sale_invoice_retur = sale.no_invoice_sale
                            AND items.id_item = sale.id_items AND customer.id_customer = sale.id_customer AND sales.id_sales = sale.id_sales");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }
    
    public function ViewSingleInvoice(){
        $data = mysqli_query($this->server->mysql, "SELECT invoice_retur.*, customer.name_customer, customer.id_customer, sales.name_sales, sales.id_sales FROM invoice_retur, sales, customer WHERE sales.id_sales = invoice_retur.id_sales_invoice_retur AND customer.id_customer = invoice_retur.id_customer_invoice_retur");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function ViewNoInvoice($no_invoice){
        $data = mysqli_query($this->server->mysql, "SELECT * FROM invoice_retur WHERE no_invoice = '$no_invoice'");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function AddInvoiceRetur($username, $id_customer_invoice, $id_sales_invoice, $sale_invoice_retur){

        $no_invoice = time();
        $total = 0;


        $date = date('Y-m-d');

        $ids = $this->uid->guidv4();

        $get_data_invoice_retur = mysqli_query($this->server->mysql, "SELECT COUNT(id_sales_invoice_retur) AS total FROM invoice_retur WHERE id_sales_invoice_retur = '$id_sales_invoice'");
        $data = mysqli_fetch_assoc($get_data_invoice_retur);
        if($get_data_invoice_retur == false){
            return $this->msg->Error("Gagal mengambil data nomor invoice retur count sales");
        }

        if($data['total'] == 0){
           $total =  1;
        }else{
           $total = (int)$data['total'] + 1;
        }

        $sum = '00'.(string)$total;
        $no_invoice = sprintf("%03d", $sum);

            $insert = mysqli_query($this->server->mysql, "INSERT INTO invoice_retur (id, id_invoice_retur, no_invoice_retur, sale_invoice_retur,
                            id_customer_invoice_retur, id_sales_invoice_retur, create_by, create_date, update_by, update_date) VALUES ('', '$ids', '$no_invoice', 
                            '$sale_invoice_retur', '$id_customer_invoice', '$id_sales_invoice', '$username', '$date', null, null)");
        
            if($insert == false){
                return $this->msg->Error("Gagal menambahkan invoice retur");
            }
        
        return $this->msg->Success('Data invoice retur berhasil disimpan');
    }

    public function Delete($id_invoice){

        $delete = mysqli_query($this->server->mysql, "DELETE FROM invoice_retur WHERE id_invoice_retur = '$id_invoice'");

        if($delete == false){
            return $this->msg->Error($delete);
        }

        return $this->msg->Success('Data invoice retur berhasil dihapus');
    }
}