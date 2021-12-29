<?php 

require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

require_once('ItemsModel.php');

class SaleModel{

    var $output = [];
    var $msg;
    var $server;
    var $uid;

    var $load_items = [];

    public function __construct()
    {
        $this->server = new Server();
        $this->msg = new MessageUtil();
        $this->uid = new UUID();

        $this->load_items = new ItemsModel();
    }

    public function View(){
        $data = mysqli_query($this->server->mysql, "SELECT items.*, customer.*, sale.*, sales.* FROM items,customer,sale,sales WHERE items.id_item = sale.id_items
                            AND customer.id_customer = sale.id_customer AND sales.id_sales = sale.id_sales");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }
    
    public function ViewId($id_sale){
        $data = mysqli_query($this->server->mysql, "SELECT items.*, customer.*, sale.*, sales.* FROM items,customer,sale,sales WHERE sale.id_selling_items = '$id_sale' AND items.id_item = sale.id_items
                            AND customer.id_customer = sale.id_customer AND sales.id_sales = sale.id_sales");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function Add($id_items, $value, $profit, $id_customer, $id_sales, $selling_amount, $selling_price_sales, $total_amount, $price_clean, $username){

        $date = date('Y-m-d');
        $month = date('m');
        $tgl_terakhir = date('Y-m-t', strtotime($date));

        $ids = $this->uid->guidv4();


        $insert = mysqli_query($this->server->mysql, "INSERT INTO sale (id, id_selling_items, id_items, id_customer, id_sales, sell_date, selling_amount, total_amount,
                            price_clean, price_sales, no_invoice_sale, create_by, create_date, update_by, update_date) VALUES ('', '$ids', '$id_items', '$id_customer', '$id_sales', 
                            '$date', '$selling_amount',  '$total_amount', '$price_clean', '$selling_price_sales', null, '$username', '$date', null, null)");
        
        if($insert == false){
            return $this->msg->Error("Gagal menambahkan penjualan baru");
        }

        $update = mysqli_query($this->server->mysql, "UPDATE items SET quantity = '$value' WHERE id_item = '$id_items'");

        if($update == false){
            return $this->msg->Error("Gagal mengupdate stock");
        }

        // SCHEDULE MONTH
        $schedule = mysqli_query($this->server->mysql, "SELECT * FROM profit WHERE MONTH(create_date) = '$month'");
        $num_schedule = mysqli_num_rows($schedule);

        if($tgl_terakhir === $date){

            if($num_schedule == 1 || $num_schedule > 1){
                $update_schedule = mysqli_query($this->server->mysql, "UPDATE profit SET final_date = '$date' WHERE MONTH(create_date) = '$month'");
                if($update_schedule == false){
                    $this->msg->Error("Gagal mengupdate profit per bulan");
                }
            }

        }

        // CEK PROFIT ID SALES
        $cek_profit = mysqli_query($this->server->mysql, "SELECT * FROM profit WHERE id_sales = '$id_sales' AND MONTH(create_date) = '$month'");
        $num = mysqli_num_rows($cek_profit);
        $rows = mysqli_fetch_array($cek_profit);

        if($num == 1){

            $sum = $rows['profit'] + $profit;

            $update_profit = mysqli_query($this->server->mysql, "UPDATE profit SET profit = '$sum', update_by = '$username', update_date = '$date' WHERE id_sales = '$id_sales'");
            if($update_profit == false){
                return $this->msg->Error("update profit dihari yang sama tidak berhasil");
            }

        }else{

            $insert_profit = mysqli_query($this->server->mysql, "INSERT INTO profit (id, id_profit, id_sales, profit, final_date, create_by, create_date, update_by, update_date)
                             VALUES ('', '$ids', '$id_sales', '$profit', null, '$username', '$date', null, null)");
            
            if($insert_profit == false){
                return $this->msg->Error("Data profit gagal disimpan");
            }

        }
        
        return $this->msg->Success('Data penjualan berhasil disimpan');
    }

    public function Update($id, $username, $name_sales, $nohp, $email, $kota, $kode_pos, $alamat){
        
        $date = date('Y-m-d');

        $name = strtoupper($name_sales);
        $update = mysqli_query($this->server->mysql, "UPDATE sales SET name_sales = '$name', no_handphone = '$nohp', email = '$email', 
                              kota = '$kota', kode_pos = '$kode_pos', alamat = '$alamat',
                              update_date = '$date', update_by = '$username' WHERE id_sales = '$id'");

        if($update == false){
            return $this->msg->Error('QUERY SQL UPDATE');
        }

        return $this->msg->Success('Data pelanggan berhasil di update');
    }

    public function Delete($id){

        $delete = mysqli_query($this->server->mysql, "DELETE FROM sales WHERE id_sales = '$id'");

        if($delete == false){
            return $this->msg->Error($delete);
        }

        return $this->msg->Success('Data pelanggan berhasil dihapus');
    }
}