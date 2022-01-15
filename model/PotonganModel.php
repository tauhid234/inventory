<?php 
require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class PotonganModel{

    var $output = [];
    var $msg;
    var $server;
    var $uid;

    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        $this->server = new Server();
        $this->msg = new MessageUtil();
        $this->uid = new UUID();
    }

    public function View(){
        $data = mysqli_query($this->server->mysql, "SELECT potongan.*, sales.id_sales, sales.name_sales FROM potongan,sales WHERE potongan.id_sales = sales.id_sales");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function AddPotongan($username, $potongan, $id_sales){

        $ids = $this->uid->guidv4();
        $date = date('Y-m-d');
        $m = date('m');

        $cek_duplicate = mysqli_query($this->server->mysql, "SELECT id_sales, potongan, create_date FROM potongan WHERE id_sales = '$id_sales', AND MONTH(create_date) = '$m'");
        $num = mysqli_num_rows($cek_duplicate);
        $array = mysqli_fetch_array($cek_duplicate);

        $sum = $array['potongan'] + $potongan;

        if($num == 1){
            $update = mysqli_query($this->server->mysql, "UPDATE potongan SET potongan = '$sum', update_by = '$username', update_date = '$date'");
            if($update == false){
                return $this->msg->Error("Gagal update potongan sales");
            }
        }

        $insert = mysqli_query($this->server->mysql, "INSERT INTO potongan (id, id_potongan, id_sales, potongan, create_by, create_date, update_by, update_date)
                               VALUES ('', '$ids', '$id_sales', '$potongan', '$username', '$date', null, null)");
        
        if($insert == false){
            return $this->msg->Error("Gagal menambahkan data baru potongan sales");
        }

        return $this->msg->Success("Data potongan sales berhasil disimpan");

    }

    public function konversiMonth($month){
        $namaBulan = "";
        switch($month){
            case "01" : $namaBulan = " Januari ";
            break;
            case "02" : $namaBulan = " Februari ";
            break;
            case "03" : $namaBulan = " Maret ";
            break;
            case "04" : $namaBulan = " April ";
            break;
            case "05" : $namaBulan = " Mei ";
            break;
            case "06" : $namaBulan = " Juni ";
            break;
            case "07" : $namaBulan = " Juli ";
            break;
            case "08" : $namaBulan = " Agustus ";
            break;
            case "09" : $namaBulan = " September ";
            break;
            case "10" : $namaBulan = " Oktober ";
            break;
            case "11" : $namaBulan = " November ";
            break;
            case "12" : $namaBulan = " Desember ";
            break;
            default:
            break;
            }
            return $namaBulan;         
    }
}
