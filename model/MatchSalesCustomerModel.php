<?php 
require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class MatchSalesCustomerModel{

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
        $data = mysqli_query($this->server->mysql, "SELECT match_sales_customer.*, customer.*, sales.* FROM match_sales_customer, customer, sales WHERE match_sales_customer.id_sales = sales.id_sales AND match_sales_customer.id_customer = customer.id_customer");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }
    
    public function ViewId($id){
        $data = mysqli_query($this->server->mysql, "SELECT * FROM match_sales_customer WHERE id_match_sales_customer = '$id'");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function ViewIdCustomerMatch($id_sales){
        $data = mysqli_query($this->server->mysql, "SELECT * FROM match_sales_customer WHERE id_sales = '$id_sales'");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function Add($username, $id_customer, $id_sales){

        $cek = mysqli_query($this->server->mysql, "SELECT * FROM match_sales_customer WHERE id_customer = '$id_customer' AND id_sales = '$id_sales'");
        $num = mysqli_num_rows($cek);
        
        if($num == 1){
            return $this->msg->Warning('Data tersebut sudah tersedia');
        }

        $cek_customer = mysqli_query($this->server->mysql, "SELECT id_customer,name_customer FROM customer WHERE id_customer = '$id_customer'");
        $array = mysqli_fetch_array($cek_customer);
        $name_customer = $array['name_customer'];

        $date = date('Y-m-d');

        $ids = $this->uid->guidv4();


        $insert = mysqli_query($this->server->mysql, "INSERT INTO match_sales_customer (id, id_match_sales_customer, id_customer, name_customer, id_sales,
                            create_by, create_date, update_by, update_date) VALUES ('', '$ids', '$id_customer', '$name_customer', '$id_sales', '$username', '$date', null, null)");
        
        if($insert == false){
            return $this->msg->Error("QUERY SQL INSERT");
        }
        
        return $this->msg->Success('Data Pelanggan Sales berhasil disimpan');
    }

    public function Update($id, $username, $id_customer, $id_sales){
        
        $date = date('Y-m-d');

        $cek_customer = mysqli_query($this->server->mysql, "SELECT id_customer,name_customer FROM customer WHERE id_customer = '$id_customer'");
        $array = mysqli_fetch_array($cek_customer);
        $name_customer = $array['name_customer'];

        $update = mysqli_query($this->server->mysql, "UPDATE match_sales_customer SET id_customer = '$id_customer', 'name_customer' = '$name_customer', id_sales = '$id_sales',
                              update_date = '$date', update_by = '$username' WHERE id_match_sales_customer = '$id'");

        if($update == false){
            return $this->msg->Error('QUERY SQL UPDATE');
        }

        return $this->msg->Success('Data Pelanggan Sales berhasil di update');
    }

    public function Delete($id){

        $delete = mysqli_query($this->server->mysql, "DELETE FROM match_sales_customer WHERE id_match_sales_customer = '$id'");

        if($delete == false){
            return $this->msg->Error($delete);
        }

        return $this->msg->Success('Data Pelanggan Sales berhasil dihapus');
    }
}