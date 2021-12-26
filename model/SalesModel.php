<?php 
require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class SalesModel{

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
        $data = mysqli_query($this->server->mysql, "SELECT * FROM sales");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function Add($username, $name_sales, $nohp, $email, $kota, $kode_pos, $alamat){

        $cek = mysqli_query($this->server->mysql, "SELECT name_sales FROM sales WHERE name_sales = '$name_sales'");
        $num = mysqli_num_rows($cek);
        
        if($num == 1){
            return $this->msg->Warning('Data dengan nama sales '.$name_sales.' sudah tersedia');
        }

        $date = date('Y-m-d');

        $ids = $this->uid->guidv4();

        $name = strtoupper($name_sales);


        $insert = mysqli_query($this->server->mysql, "INSERT INTO sales (id, id_sales, name_sales, no_handphone_sales, email_sales, kota_sales, kode_pos_sales, alamat_sales,
                            create_date, create_by, update_date, update_by) VALUES ('', '$ids', '$name', '$nohp', '$email', 
                            '$kota', '$kode_pos',  '$alamat', '$date', '$username', null, null)");
        
        if($insert == false){
            return $this->msg->Error("QUERY SQL INSERT");
        }
        
        return $this->msg->Success('Data pelanggan berhasil disimpan');
    }

    public function Update($id, $username, $name_sales, $nohp, $email, $kota, $kode_pos, $alamat){
        
        $date = date('Y-m-d');

        $name = strtoupper($name_sales);
        $update = mysqli_query($this->server->mysql, "UPDATE sales SET name_sales = '$name', no_handphone_sales = '$nohp', email_sales = '$email', 
                              kota_sales = '$kota', kode_pos_sales = '$kode_pos', alamat_sales = '$alamat',
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