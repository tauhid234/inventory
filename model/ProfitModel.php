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
        date_default_timezone_set("Asia/Jakarta");
        $this->server = new Server();
        $this->msg = new MessageUtil();
        $this->uid = new UUID();
    }

    public function View(){
        // $data = mysqli_query($this->server->mysql, "SELECT profit.*, sales.* FROM profit,sales WHERE profit.id_sales = sales.id_sales AND profit.final_date IS NOT NULL");
        $data = mysqli_query($this->server->mysql, "SELECT profit.*, sales.id_sales, sales.name_sales FROM profit,sales WHERE profit.id_sales = sales.id_sales");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function ViewCustom($id_sales, $bulan, $tahun){
        $data = mysqli_query($this->server->mysql, "SELECT profit.*, sales.id_sales, sales.name_sales FROM profit,sales WHERE profit.id_sales = sales.id_sales AND profit.id_sales = '$id_sales' AND MONTH(profit.create_date) = '$bulan' AND YEAR(profit.create_date) = '$tahun'");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }
    

    public function SyncronizeProfit($id_sales, $bulan, $tahun, $username){

        $date = date('Y-m-d');
        $month = date('m');
        $year = date('Y');
        $tgl_terakhir = date('Y-m-t', strtotime($date));

        if($tgl_terakhir === $date){

            $cek_pendapatan_profit = mysqli_query($this->server->mysql, "SELECT * FROM profit WHERE id_sales = '$id_sales'");
            $array = mysqli_fetch_array($cek_pendapatan_profit);

        //     // JIKA PENDAPATAN 16.700.000 ATAU LEBIH -> DIBAGI 35%
            if((int) $array['profit'] == 16700000 || (int)$array['profit'] > 16700000){
                $sumMax = (int) $array['profit'] / 100 * 35;
                $total_pendapatan_sales = (int) $sumMax -  (int) $array['potongan_sales'];
                $updateMax = mysqli_query($this->server->mysql, "UPDATE profit SET profit = '$sumMax', total_pendapatan_sales = '$total_pendapatan_sales', update_by = '$username', update_date = '$date' WHERE id_sales = '$id_sales'");
                if($updateMax == false){
                    return $this->msg->Error("Gagal update profit pendapatan lebih dari 16.700.000");
                }
            }else{

                // JIKA KURANG DARI 16.700.000 -> DIBAGI 30%
                $sumMin = (int) $array['profit'] / 100 * 30;
                $total_pendapatan_saless = (int)$sumMin -  (int)$array['potongan_sales'];
                $updateMin = mysqli_query($this->server->mysql, "UPDATE profit SET profit = '$sumMin', total_pendapatan_sales = '$total_pendapatan_saless', update_by = '$username', update_date = '$date' WHERE id_sales = '$id_sales'");
                if($updateMin == false){
                    return $this->msg->Error("Gagal update profit pendapatan kurang dari 16.700.000");
                }
            }

            $update = mysqli_query($this->server->mysql, "UPDATE profit SET final_date = '$date', update_by = '$username', update_date = '$date' WHERE MONTH(create_date) = '$month' AND id_sales = '$id_sales'");
            if($update == false){
                return $this->msg->Error("Gagal Syncronize data");
            }
            return $this->msg->Success("Berhasil mensyncronize data");

        }else if((int) $bulan == $month && (int) $tahun == $year){
            return $this->msg->Info("Tunggu sampai akhir bulan untuk mensyncronize data profit");
        }
        else if((int)$bulan < $month && (int)$tahun < $year || (int)$tahun == $year){

            $cek_pendapatan_profit = mysqli_query($this->server->mysql, "SELECT * FROM profit WHERE id_sales = '$id_sales' AND MONTH(create_date) = '$bulan' AND YEAR(create_date) = '$tahun'");
            $array = mysqli_fetch_array($cek_pendapatan_profit);

            if($array['total_pendapatan_sales'] != "" || $array['total_pendapatan_sales'] != 0){
                return;
            }else{

                 // JIKA PENDAPATAN 16.700.000 ATAU LEBIH -> DIBAGI 35%
                if((int) $array['profit'] == 16700000 || (int)$array['profit'] > 16700000){
                    $sumMax = (int) $array['profit'] / 100 * 35;
                    $total_pendapatan_sales = (int) $sumMax -  (int) $array['potongan_sales'];
                    $updateMax = mysqli_query($this->server->mysql, "UPDATE profit SET profit = '$sumMax', total_pendapatan_sales = '$total_pendapatan_sales', update_by = '$username', update_date = '$date' WHERE id_sales = '$id_sales' AND MONTH(create_date) = '$bulan' AND YEAR(create_date) = '$tahun'");
                    if($updateMax == false){
                        return $this->msg->Error("Gagal update profit pendapatan lebih dari 16.700.000");
                    }
                }else{

                    // JIKA KURANG DARI 16.700.000 -> DIBAGI 30%
                    $sumMin = (int) $array['profit'] / 100 * 30;
                    $total_pendapatan_saless = (int)$sumMin -  (int)$array['potongan_sales'];
                    $updateMin = mysqli_query($this->server->mysql, "UPDATE profit SET profit = '$sumMin', total_pendapatan_sales = '$total_pendapatan_saless', update_by = '$username', update_date = '$date' WHERE id_sales = '$id_sales' AND MONTH(create_date) = '$bulan' AND YEAR(create_date) = '$tahun'");
                    if($updateMin == false){
                        return $this->msg->Error("Gagal update profit pendapatan kurang dari 16.700.000");
                    }
                }

                $update = mysqli_query($this->server->mysql, "UPDATE profit SET update_by = '$username', update_date = '$date' WHERE id_sales = '$id_sales' AND MONTH(create_date) = '$bulan' AND YEAR(create_date) = '$tahun'");
                if($update == false){
                    return $this->msg->Error("Gagal Syncronize data");
                }


                return $this->msg->Success("Berhasil mensyncronize data else if");
            }

        }
        else{
            return $this->msg->Info("Tunggu sampai akhir bulan untuk mensyncronize data profit");
        }
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
