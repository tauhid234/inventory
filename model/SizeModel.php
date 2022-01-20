<?php 

require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class SizeModel {
    
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
        $data = mysqli_query($this->server->mysql, "SELECT * FROM size");
        while($d = mysqli_fetch_assoc($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function Add($nama_size){

        $cek = mysqli_query($this->server->mysql, "SELECT jenis_ukuran FROM size WHERE jenis_ukuran = '$nama_size'");
        $num = mysqli_num_rows($cek);

        $date = date('Y-m-d');

        $ids = $this->uid->guidv4();

        $name = strtoupper($nama_size);

        if($num == 1){
            return $this->msg->Warning('Data dengan nama ukuran '.$name.' sudah tersedia');
        }

        $insert = mysqli_query($this->server->mysql, "INSERT INTO size (id, jenis_ukuran) VALUES ('', '$name')");
        if($insert == false){
            return $this->msg->Error("Data nama ukuran ".$name." Gagal disimpan");
        }
        return $this->msg->Success('Data ukuran berhasil disimpan');
    }
}