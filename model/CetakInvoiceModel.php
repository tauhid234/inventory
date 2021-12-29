<?php 
require_once('../../../server/server.php');
require_once('../../../util/MessageUtil.php');
require_once('../../../util/UUID.php');

class CetakInvoiceModel{

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

    public function ViewId($id){
        $data = mysqli_query($this->server->mysql, "SELECT invoice.*, sale.*, items.*, sales.*, customer.* FROM invoice, sale, sales, items, customer WHERE invoice.id_invoice = '$id' AND invoice.id_sale = sale.id_selling_items
                            AND items.id_item = sale.id_items AND customer.id_customer = sale.id_customer AND sales.id_sales = sale.id_sales");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }
}