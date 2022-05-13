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
        $data = mysqli_query($this->server->mysql, "SELECT * FROM items WHERE status = 1");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function ViewItemSale(){
        $data = mysqli_query($this->server->mysql, "SELECT * FROM items WHERE status = 1 AND quantity != '0'");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function ViewItemPurchase(){
        $data = mysqli_query($this->server->mysql, "SELECT * FROM items WHERE status = 1");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function Count(){
        $data = mysqli_query($this->server->mysql, "SELECT COUNT(*) AS total FROM items");
        $fetch = mysqli_fetch_array($data);

        return $fetch['total'];
    }


    public function ViewId($id){
        $data = mysqli_query($this->server->mysql, "SELECT * FROM items WHERE id_item = '$id'");
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

    public function Add($username, $name_item, $size, $size_type, $quantity, $unit_type, $purchase_price, $selling_price){

        if($name_item == "" || $name_item == null || strlen(trim($name_item))<=0){
            return $this->msg->Warning("Harap input nama item terlebih dahulu");
        }

        if($size == "" || $size == null || strlen(trim($size))<=0){
            return $this->msg->Warning("Harap input nomor ukuran terlebih dahulu");
        }

        if($size_type == "" || $size_type == null){
            return $this->msg->Warning("Harap pilih jenis ukuran terlebih dahulu");
        }

        if($quantity == "" || $quantity == null){
            return $this->msg->Warning("Harap input kuantitas terlebih dahulu");
        }

        if($unit_type == "" || $unit_type == null){
            return $this->msg->Warning("Harap pilih jenis satuan terlebih dahulul");
        }

        if($purchase_price == "" || $purchase_price == null){
            return $this->msg->Warning("Harap input harga pembelian terlebih dahulu");
        }

        if($selling_price == "" || $selling_price == null){
            return $this->msg->Warning("Harap input harga penjualan terlebih dahulu");
        }

        if($selling_price == 0 || $selling_price < 0){
            return $this->msg->Warning("Harap inputkan harga penjualan lebih dari 0 !");
        }

        if($purchase_price == 0 || $purchase_price < 0){
            return $this->msg->Warning("Harap inputkan harga pembelian lebih dari 0 !");
        }

        if($quantity < 0){
            return $this->msg->Warning("Harap inputkan kuantitas tidak kurang dari 0 !");
        }

        $cek = mysqli_query($this->server->mysql, "SELECT name_item,status FROM items WHERE name_item = '$name_item' AND status = 1");
        $num = mysqli_num_rows($cek);

        $date = date('Y-m-d');

        $ids = $this->uid->guidv4();

        $item_name = strtoupper($name_item);

        if($num == 1){
            return $this->msg->Warning('Data dengan nama item '.$name_item.' sudah tersedia');
        }

        $insert = mysqli_query($this->server->mysql, "INSERT INTO items (id, id_item, name_item, size, size_type, quantity, unit_type, purchase_price,
                            selling_price, create_date, create_by, update_date, update_by, status) VALUES ('', '$ids', '$item_name', '$size', '$size_type', 
                            '$quantity', '$unit_type', '$purchase_price', '$selling_price', '$date', '$username', null, null, 1)");
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


    // SOFT DELETE
    public function Delete($id){

        $delete = mysqli_query($this->server->mysql, "UPDATE items SET status = 0 WHERE id_item = '$id'");

        if($delete == false){
            return $this->msg->Error($delete);
        }

        return $this->msg->Success('Data barang berhasil dihapus');
    }
}