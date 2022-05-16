<?php 
require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class SuplierModel{

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
        $data = mysqli_query($this->server->mysql, "SELECT * FROM suplier");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function ViewId($id){
        $data = mysqli_query($this->server->mysql, "SELECT * FROM suplier WHERE id_suplier = '$id'");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function Add($username, $name_suplier, $nohp, $email, $kota, $kode_pos, $alamat){

        $cek = mysqli_query($this->server->mysql, "SELECT name_suplier FROM suplier WHERE name_suplier = '$name_suplier'");
        $num = mysqli_num_rows($cek);
        
        if($num == 1){
            return $this->msg->Warning('Data dengan nama suplier '.$name_suplier.' sudah tersedia');
        }

        $date = date('Y-m-d');

        $ids = $this->uid->guidv4();

        $name = strtoupper($name_suplier);


        $insert = mysqli_query($this->server->mysql, "INSERT INTO suplier (id, id_suplier, name_suplier, no_handphone_suplier, email_suplier, kota_suplier, kode_pos_suplier, alamat_suplier,
                            create_date, create_by, update_date, update_by) VALUES ('', '$ids', '$name', '$nohp', '$email', 
                            '$kota', '$kode_pos',  '$alamat', '$date', '$username', null, null)");
        
        if($insert == false){
            return $this->msg->Error("QUERY SQL INSERT");
        }
        
        return $this->msg->Success('Data suplier berhasil disimpan');
    }

    public function Update($id, $username, $name_suplier, $nohp, $email, $kota, $kode_pos, $alamat){
        
        $date = date('Y-m-d');

        $name = strtoupper($name_suplier);
        $update = mysqli_query($this->server->mysql, "UPDATE suplier SET name_suplier = '$name', no_handphone_suplier = '$nohp', email_suplier = '$email', 
                              kota_suplier = '$kota', kode_pos_suplier = '$kode_pos', alamat_suplier = '$alamat',
                              update_date = '$date', update_by = '$username' WHERE id_suplier = '$id'");

        if($update == false){
            return $this->msg->Error('QUERY SQL UPDATE');
        }

        return $this->msg->Success('Data suplier berhasil di update');
    }

    public function Delete($id){

        $delete = mysqli_query($this->server->mysql, "DELETE FROM suplier WHERE id_suplier = '$id'");

        if($delete == false){
            return $this->msg->Error($delete);
        }

        return $this->msg->Success('Data suplier berhasil dihapus');
    }
}