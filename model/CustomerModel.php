<?php

require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class CustomerModel{
    
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
        $data = mysqli_query($this->server->mysql, "SELECT * FROM customer");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function Add($username, $name_customer, $name_toko, $nomor_toko, $nohp, $email, $kota, $kode_pos, $alamat_toko){

        $cek = mysqli_query($this->server->mysql, "SELECT name_customer FROM customer WHERE name_customer = '$name_customer'");
        $num = mysqli_num_rows($cek);
        
        if($num == 1){
            return $this->msg->Warning('Data dengan nama pelanggan '.$name_customer.' sudah tersedia');
        }

        $date = date('Y-m-d');

        $ids = $this->uid->guidv4();

        $name = strtoupper($name_customer);


        $insert = mysqli_query($this->server->mysql, "INSERT INTO customer (id, id_customer, name_customer, no_handphone_customer, email_customer, kota_customer, kode_pos_customer, name_toko, nomor_toko, alamat_toko,
                            create_date, create_by, update_date, update_by) VALUES ('', '$ids', '$name', '$nohp', '$email', 
                            '$kota', '$kode_pos', '$name_toko', '$nomor_toko',  '$alamat_toko', '$date', '$username', null, null)");
        
        if($insert == false){
            return $this->msg->Error("QUERY SQL INSERT");
        }
        
        return $this->msg->Success('Data pelanggan berhasil disimpan');
    }

    public function Update($id, $username, $name_customer, $name_toko, $nomor_toko, $nohp, $email, $kota, $kode_pos, $alamat_toko){
        
        $date = date('Y-m-d');

        $name = strtoupper($name_customer);
        $update = mysqli_query($this->server->mysql, "UPDATE customer SET name_customer = '$name', no_handphone_customer = '$nohp', email_customer = '$email', 
                              kota_customer = '$kota', kode_pos_customer = '$kode_pos', name_toko = '$name_toko', nomor_toko = '$nomor_toko', alamat_toko = '$alamat_toko',
                              update_date = '$date', update_by = '$username' WHERE id_customer = '$id'");

        if($update == false){
            return $this->msg->Error('QUERY SQL UPDATE');
        }

        return $this->msg->Success('Data pelanggan berhasil di update');
    }

    public function Delete($id){

        $delete = mysqli_query($this->server->mysql, "DELETE FROM customer WHERE id_customer = '$id'");

        if($delete == false){
            return $this->msg->Error($delete);
        }

        return $this->msg->Success('Data pelanggan berhasil dihapus');
    }
}