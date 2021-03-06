<?php 
require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class ReportProfitSalesModel{

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
        $data = mysqli_query($this->server->mysql, "SELECT report_profit_sales.*, sales.id_sales, sales.name_sales, customer.id_customer, customer.name_customer, items.id_item, items.name_item FROM report_profit_sales, customer, sales, items WHERE report_profit_sales.id_sales_report = sales.id_sales AND report_profit_sales.id_customer_report = customer.id_customer
                             AND report_profit_sales.id_items_report = items.id_item");
        while($d = mysqli_fetch_assoc($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }
}