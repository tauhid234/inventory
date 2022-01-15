<?php 

require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class RaftsModel {
    
    var $server;
    var $output = [];
    var $msg;

    var $uid;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->server = new Server();
        $this->msg = new MessageUtil();
        $this->uid = new UUID();
    }

    public function View(){
        $data = mysqli_query($this->server->mysql, "SELECT * FROM rafts WHERE status_rafts != 'DONE_REPAIR'");
        while($d = mysqli_fetch_assoc($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }


    public function ViewId($id){
        $data = mysqli_query($this->server->mysql, "SELECT * FROM rafts WHERE id_rafts = '$id'");
        $num = mysqli_num_rows($data);
        if($num == 0){
            return $this->msg->Error("Id tidak valid");
        }
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function Add($username, $name_item, $size, $size_type, $quantity, $unit_type){

        $date = date('Y-m-d');
        $ids = $this->uid->guidv4();

        $select_item = mysqli_query($this->server->mysql, "SELECT * FROM items WHERE name_item = '$name_item'");
        $array = mysqli_fetch_array($select_item);

        $sum = (int)$array['quantity'] - (int)$quantity;

        if($sum < 0){
            return $this->msg->Warning("Nama Barang ".$name_item." untuk rakit tidak boleh melebihi kapasitas stock saat ini !");
        }

        $update_stock = mysqli_query($this->server->mysql, "UPDATE items SET quantity = '$sum' WHERE name_item = '$name_item'");
        if($update_stock == false){
            return $this->msg->Error("Gagal mengurangi jumlah stock pada data barang");
        }

        $insert = mysqli_query($this->server->mysql, "INSERT INTO rafts (id, id_rafts, name_rafts, size_rafts, size_type_rafts, quantity_rafts, unit_type_rafts,
                             create_date, create_by, update_date, update_by) VALUES ('', '$ids', '$name_item', '$size', '$size_type', 
                            '$quantity', '$unit_type', '$date', '$username', null, null)");
        if($insert == false){
            return $this->msg->Error($insert.$ids);
        }

        return $this->msg->Success('Data barang rakit berhasil disimpan');
    }

    public function Update($id, $name_item, $username, $quantity, $status){
        
        $date = date('Y-m-d');

        $cek_item = mysqli_query($this->server->mysql, "SELECT * FROM items WHERE name_item = '$name_item'");
        $array = mysqli_fetch_array($cek_item);

        $sum = (int) $array['quantity'] + $quantity;

        if($status == "DONE_REPAIR"){
            $update_item = mysqli_query($this->server->mysql, "UPDATE items SET quantity = '$sum', update_by = '$username', update_date = '$date' WHERE name_item = '$name_item'");
            if($update_item == false){
                return $this->msg->Error("Gagal mengupdate stock data barang");
            }
        }

        $update_rafts = mysqli_query($this->server->mysql, "UPDATE rafts SET status_rafts = '$status', update_by = '$username', update_date = '$date' WHERE id_rafts = '$id'");
        if($update_rafts == false){
            return $this->msg->Error("Gagal mengupdate status perbaikan barang rakit");
        }

        return $this->msg->Success("Data barang rakit berhasil di update");
    }

    public function Delete($id){

        $delete = mysqli_query($this->server->mysql, "DELETE FROM rafts WHERE id_rafts = '$id'");

        if($delete == false){
            return $this->msg->Error($delete);
        }

        return $this->msg->Success('Data barang rakit berhasil dihapus');
    }
}