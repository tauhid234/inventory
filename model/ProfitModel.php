<?php 
require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class ProfitModel{

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
        $data = mysqli_query($this->server->mysql, "SELECT profit.*, sales.* FROM profit,sales WHERE profit.id_sales = sales.id_sales AND profit.final_date IS NOT NULL");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function SyncronizeProfit(){

        $date = date('Y-m-d');
        $month = date('m');
        $tgl_terakhir = date('Y-m-t', strtotime($date));

        if($tgl_terakhir === $date){

            $update = mysqli_query($this->server->mysql, "UPDATE profit SET final_date = '$date' WHERE MONTH(create_date) = '$month'");
            if($update == false){
                return $this->msg->Error("Gagal Syncronize data");
            }
            return $this->msg->Success("Berhasil mensyncronize data");
        }else{
            return $this->msg->Info("Tunggu sampai akhir bulan untuk mensyncronize data profit");
        }
    }
}
