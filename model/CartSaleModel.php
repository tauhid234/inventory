<?php 

require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class CartSaleModel {
    
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

    public function ViewCartSale($username){
        $data = mysqli_query($this->server->mysql, "SELECT * FROM cart_sale WHERE session_cart = '$username'");
        $num = mysqli_num_rows($data);
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function Add($id_item, $username){

        $cek = mysqli_query($this->server->mysql, "SELECT * FROM items WHERE id_item = '$id_item' AND status = 1");
        $array = mysqli_fetch_array($cek);

        $id_cart = $array['id_item'];
        $name_item_cart = strtoupper($array['name_item']);
        $size_cart = $array['size'];
        $size_type_cart = $array['size_type'];
        $quantity_cart = $array['quantity'];
        $unit_type_cart = $array['unit_type'];
        $purchase_price = $array['purchase_price'];
        $selling_price_cart = $array['selling_price'];

        $date = date('Y-m-d');

        $ids = $this->uid->guidv4();

        $cek_cart = mysqli_query($this->server->mysql, "SELECT * FROM cart_sale WHERE id_cart = '$id_cart'");
        $row = mysqli_num_rows($cek_cart);

        if($row == 1){
            return $this->msg->Warning('Data dengan nama barang '.$name_item_cart.' sudah ditambahkan di penjualan');
        }

        $insert = mysqli_query($this->server->mysql, "INSERT INTO cart_sale (id, id_cart, name_cart, size_cart, size_type_cart, quantity_cart, unit_type_cart, purchase_price_cart,
                            selling_price_cart, create_date, create_by, update_date, update_by, session_cart) VALUES ('', '$id_cart', '$name_item_cart', '$size_cart', '$size_type_cart', 
                            '$quantity_cart', '$unit_type_cart', '$purchase_price', '$selling_price_cart', '$date', '$username', null, null, '$username')");
        if($insert == false){
            return $this->msg->Error($insert.$ids);
        }
        // return $this->msg->Success('Data barang berhasil di');
    }


    // HARD DELETE
    public function Delete($id){

        $delete = mysqli_query($this->server->mysql, "DELETE FROM cart_sale WHERE id_cart = '$id'");

        if($delete == false){
            return $this->msg->Error($delete);
        }

        return $this->msg->Success('Data berhasil dihapus');
    }
}