<?php 

require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class UnitModel {
    
    var $server;
    var $output = [];
    var $msg;

    var $uid;

    public function __construct()
    {
        $this->server = new Server();
        $this->msg = new MessageUtil();
        $this->uid = new UUID();
    }

    public function View(){
        $data = mysqli_query($this->server->mysql, "SELECT * FROM unit");
        while($d = mysqli_fetch_assoc($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function Add($nama_unit){

        if($nama_unit == "" || $nama_unit == null || strlen(trim($nama_unit))<=0){
            return $this->msg->Warning("Harap input nama ukuran terlebih dahulu");
        }

        $cek = mysqli_query($this->server->mysql, "SELECT unit_type FROM unit WHERE unit_type = '$nama_unit'");
        $num = mysqli_num_rows($cek);

        $date = date('Y-m-d');

        $ids = $this->uid->guidv4();

        $name = strtoupper($nama_unit);

        if($num == 1){
            return $this->msg->Warning('Data dengan nama ukuran '.$name.' sudah tersedia');
        }

        $insert = mysqli_query($this->server->mysql, "INSERT INTO unit (id, unit_type) VALUES ('', '$name')");
        if($insert == false){
            return $this->msg->Error("Data nama satuan ".$name." Gagal disimpan");
        }
        return $this->msg->Success('Data jenis satuan berhasil disimpan');
    }
}