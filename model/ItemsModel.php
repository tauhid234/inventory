<?php 

require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class ItemsModel {
    
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
        $data = mysqli_query($this->server->mysql, "SELECT * FROM items");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function Add($username, $name_item, $size, $size_type, $quantity, $unit_type, $purchase_price, $selling_price){

        $cek = mysqli_query($this->server->mysql, "SELECT name_item FROM items WHERE name_item = '$name_item'");
        $num = mysqli_num_rows($cek);

        $date = date('Y-m-d');

        $ids = $this->uid->guidv4();

        $item_name = strtoupper($name_item);

        if($num == 1){
            return $this->msg->Warning('Data dengan nama item '.$name_item.' sudah tersedia');
        }

        $insert = mysqli_query($this->server->mysql, "INSERT INTO items (id, id_item, name_item, size, size_type, quantity, unit_type, purchase_price,
                            selling_price, create_date, create_by, update_date, update_by) VALUES ('', '$ids', '$item_name', '$size', '$size_type', 
                            '$quantity', '$unit_type', '$purchase_price', '$selling_price', '$date', '$username', null, null)");
        if($insert == false){
            return $this->msg->Error($insert.$ids);
        }
        return $this->msg->Success('Data barang berhasil disimpan');
    }

    public function Update($id, $username, $name_item, $size, $size_type, $quantity, $unit_type, $purchase_price, $selling_price){
        
        $date = date('Y-m-d');

        $item_name = strtoupper($name_item);
        $update = mysqli_query($this->server->mysql, "UPDATE items SET name_item = '$item_name', size = '$size', size_type = '$size_type', 
                              quantity = '$quantity', unit_type = '$unit_type', purchase_price = '$purchase_price', selling_price = '$selling_price',
                              update_date = '$date', update_by = '$username' WHERE id_item = '$id'");

        if($update == false){
            return $this->msg->Error($update);
        }

        return $this->msg->Success('Data barang berhasil di update');
    }

    public function Delete($id){

        $delete = mysqli_query($this->server->mysql, "DELETE FROM items WHERE id_item = '$id'");

        if($delete == false){
            return $this->msg->Error($delete);
        }

        return $this->msg->Success('Data barang berhasil dihapus');
    }
}