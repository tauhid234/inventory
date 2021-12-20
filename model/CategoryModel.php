<?php 
require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');

class CategoryModel{

    var $server;
    var $output;
    var $msg;

    public function __construct()
    {
        $this->server = new Server();
        $this->msg = new MessageUtil();
    }

    public function View(){
        $data = mysqli_query($this->server->mysql, "SELECT * FROM category");
        while($d = mysqli_fetch_assoc($data)){
            $this->output[] = $d;
        }    
        return $this->output;
    }

    public function Add($nama_category){
        
        $name = strtoupper($nama_category);
        $data = mysqli_query($this->server->mysql, "SELECT * FROM category WHERE name_category = '$name'");
        $num = mysqli_num_rows($data);
        if($num == 1){
            return $this->msg->Warning('Data dengan nama kategori tersebut sudah tersedia');
        }

        $insert = mysqli_query($this->server->mysql, "INSERT INTO category (id, name_category) VALUES ('', '$name')");
        return $this->msg->Success('Data kategori berhasil disimpan');
    }

    public function Update($id, $nama_category){

        $name = strtoupper($nama_category);
        $cek = mysqli_query($this->server->mysql, "SELECT * FROM category WHERE id = '$id'");
        $num = mysqli_num_rows($cek);
        if($num == 0){
            return $this->msg->Error('Data id tersebut tidak valid');
        }

        $update = mysqli_query($this->server->mysql, "UPDATE category SET name_category = '$name' WHERE id = '$id'");
        return $this->msg->Success('Data kategori berhasil di update');
    }

    public function Delete($id){
        $data = mysqli_query($this->server->mysql, "DELETE FROM category WHERE id = '$id'");
        return $this->msg->Success('Data kategori berhasil dihapus');
    }
}