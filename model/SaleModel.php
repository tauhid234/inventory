<?php 

require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

require_once('ItemsModel.php');

class SaleModel{

    var $output = [];
    var $msg;
    var $server;
    var $uid;

    var $load_items = [];

    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        $this->server = new Server();
        $this->msg = new MessageUtil();
        $this->uid = new UUID();

        $this->load_items = new ItemsModel();
    }

    public function View(){
        $data = mysqli_query($this->server->mysql, "SELECT items.*, customer.*, sale.*, sales.* FROM items,customer,sale,sales WHERE items.id_item = sale.id_items
                            AND customer.id_customer = sale.id_customer AND sales.id_sales = sale.id_sales");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function ViewRangeDate($tgl_mulai, $tgl_akhir){
        $data = mysqli_query($this->server->mysql, "SELECT items.*, customer.*, sale.*, sales.* FROM items,customer,sale,sales WHERE sale.sell_date >= '$tgl_mulai' AND sale.sell_date <= '$tgl_akhir' AND items.id_item = sale.id_items
                            AND customer.id_customer = sale.id_customer AND sales.id_sales = sale.id_sales");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }
    
    public function ViewId($id_sale){
        $data = mysqli_query($this->server->mysql, "SELECT items.*, customer.*, sale.*, sales.* FROM items,customer,sale,sales WHERE sale.id_selling_items = '$id_sale' AND items.id_item = sale.id_items
                            AND customer.id_customer = sale.id_customer AND sales.id_sales = sale.id_sales");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }
    
    public function ViewSaleInvoice($no_invoice, $versi){
        $data = mysqli_query($this->server->mysql, "SELECT items.name_item, items.id_item,
                             customer.name_customer, customer.id_customer,
                             sale.no_invoice_sale, sale.sell_date, sale.selling_amount, sale.total_amount, sale.id_selling_items, sale.id_items, sale.id_customer, sale.id_sales, sale.price_sales, sale.id, sale.sale_versi,
                             sales.name_sales, sales.id_sales,
                             invoice.sale_versi_invoice, invoice.status_pay
                             FROM items,customer,sale,sales,invoice WHERE sale.sale_versi = '$versi' AND items.id_item = sale.id_items AND invoice.sale_versi_invoice = '$versi'
                             AND customer.id_customer = sale.id_customer AND sales.id_sales = sale.id_sales");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function Add($id_items, $value, $profit, $id_customer, $id_sales, $selling_amount, $selling_price_sales, $total_amount, $price_clean, $username){

        $date = date('Y-m-d');
        $month = date('m');
        $tgl_terakhir = date('Y-m-t', strtotime($date));

        $ids = $this->uid->guidv4();


        $insert = mysqli_query($this->server->mysql, "INSERT INTO sale (id, id_selling_items, id_items, id_customer, id_sales, sell_date, selling_amount, total_amount,
                            price_clean, price_sales, no_invoice_sale, create_by, create_date, update_by, update_date) VALUES ('', '$ids', '$id_items', '$id_customer', '$id_sales', 
                            '$date', '$selling_amount',  '$total_amount', '$price_clean', '$selling_price_sales', null, '$username', '$date', null, null)");
        
        if($insert == false){
            return $this->msg->Error("Gagal menambahkan penjualan baru");
        }

        $update = mysqli_query($this->server->mysql, "UPDATE items SET quantity = '$value' WHERE id_item = '$id_items'");

        if($update == false){
            return $this->msg->Error("Gagal mengupdate stock");
        }

        // SCHEDULE MONTH
        $schedule = mysqli_query($this->server->mysql, "SELECT * FROM profit WHERE MONTH(create_date) = '$month'");
        $num_schedule = mysqli_num_rows($schedule);

        if($tgl_terakhir === $date){

            if($num_schedule == 1 || $num_schedule > 1){
                $update_schedule = mysqli_query($this->server->mysql, "UPDATE profit SET final_date = '$date' WHERE MONTH(create_date) = '$month'");
                if($update_schedule == false){
                    $this->msg->Error("Gagal mengupdate profit per bulan");
                }
            }

        }

        // CEK PROFIT ID SALES
        $cek_profit = mysqli_query($this->server->mysql, "SELECT * FROM profit WHERE id_sales = '$id_sales' AND MONTH(create_date) = '$month'");
        $num = mysqli_num_rows($cek_profit);
        $rows = mysqli_fetch_array($cek_profit);

        if($num == 1){

            $sum = $rows['profit'] + $profit;

            $update_profit = mysqli_query($this->server->mysql, "UPDATE profit SET profit = '$sum', update_by = '$username', update_date = '$date' WHERE id_sales = '$id_sales'");
            if($update_profit == false){
                return $this->msg->Error("update profit dihari yang sama tidak berhasil");
            }

        }else{

            $insert_profit = mysqli_query($this->server->mysql, "INSERT INTO profit (id, id_profit, id_sales, profit, final_date, create_by, create_date, update_by, update_date)
                             VALUES ('', '$ids', '$id_sales', '$profit', null, '$username', '$date', null, null)");
            
            if($insert_profit == false){
                return $this->msg->Error("Data profit gagal disimpan");
            }

        }
        
        return $this->msg->Success('Data penjualan berhasil disimpan');
    }
    
    public function AddPenjualan($id_items, $value, $profit, $id_customer, $id_sales, $selling_amount, $selling_price_sales, $sale_versi, $total_amount, $price_clean, $username){

        $date = date('Y-m-d');
        $month = date('m');
        $tgl_terakhir = date('Y-m-t', strtotime($date));

        $ids = $this->uid->guidv4();


        $insert = mysqli_query($this->server->mysql, "INSERT INTO sale (id, id_selling_items, id_items, id_customer, id_sales, sell_date, selling_amount, total_amount,
                            price_clean, price_sales, sale_versi, no_invoice_sale, create_by, create_date, update_by, update_date) VALUES ('', '$ids', '$id_items', '$id_customer', '$id_sales', 
                            '$date', '$selling_amount',  '$total_amount', '$price_clean', '$selling_price_sales', '$sale_versi', null, '$username', '$date', null, null)");
        
        if($insert == false){
            return $this->msg->Error("Gagal menambahkan penjualan baru");
        }

        $update = mysqli_query($this->server->mysql, "UPDATE items SET quantity = '$value', update_by = '$username', update_date = '$date' WHERE id_item = '$id_items'");

        if($update == false){
            return $this->msg->Error("Gagal mengupdate stock");
        }

        // SCHEDULE MONTH
        $schedule = mysqli_query($this->server->mysql, "SELECT * FROM profit WHERE MONTH(create_date) = '$month'");
        $num_schedule = mysqli_num_rows($schedule);

        if($tgl_terakhir === $date){

            if($num_schedule == 1 || $num_schedule > 1){
                $update_schedule = mysqli_query($this->server->mysql, "UPDATE profit SET final_date = '$date' WHERE MONTH(create_date) = '$month'");
                if($update_schedule == false){
                    $this->msg->Error("Gagal mengupdate profit per bulan");
                }
            }

        }

        // CEK PROFIT ID SALES
        $cek_profit = mysqli_query($this->server->mysql, "SELECT * FROM profit WHERE id_sales = '$id_sales' AND MONTH(create_date) = '$month'");
        $num = mysqli_num_rows($cek_profit);
        $rows = mysqli_fetch_array($cek_profit);

        if($num == 1){

            $sum = $rows['profit'] + $profit;

            $update_profit = mysqli_query($this->server->mysql, "UPDATE profit SET profit = '$sum', update_by = '$username', update_date = '$date' WHERE id_sales = '$id_sales'");
            if($update_profit == false){
                return $this->msg->Error("update profit dihari yang sama tidak berhasil");
            }

        }else{

            $insert_profit = mysqli_query($this->server->mysql, "INSERT INTO profit (id, id_profit, id_sales, profit, final_date, create_by, create_date, update_by, update_date)
                             VALUES ('', '$ids', '$id_sales', '$profit', null, '$username', '$date', null, null)");
            
            if($insert_profit == false){
                return $this->msg->Error("Data profit gagal disimpan");
            }

        }
        
        return $this->msg->Success('Data penjualan berhasil disimpan');
    }

    public function AddPenjualanV2($id_items, $value, $profit, $id_customer, $id_sales, $selling_amount, $selling_price_sales, $sale_versi, $total_amount, $price_clean, $username){

        $date = date('Y-m-d');
        $month = date('m');
        $tgl_terakhir = date('Y-m-t', strtotime($date));

        $ids = $this->uid->guidv4();
        $total = 0;

        if($id_customer == "" || $id_sales == ""){
            return $this->msg->Warning("Harap pilih nama pelanggan dan sales dahulu");
        }

        $get_data_invoice = mysqli_query($this->server->mysql, "SELECT COUNT(id_sales_invoice) AS total FROM invoice WHERE id_sales_invoice = '$id_sales'");
        $data = mysqli_fetch_assoc($get_data_invoice);
        if($get_data_invoice == false){
            return $this->msg->Error("Gagal mengambil data nomor invoice count sales");
        }

        $total = $data['total'];

        $sum = '00'.(string)$total;
        $no_invoice = sprintf("%03d", $sum);

        if($selling_price_sales != ""){

            $insert = mysqli_query($this->server->mysql, "INSERT INTO sale (id, id_selling_items, id_items, id_customer, id_sales, sell_date, selling_amount, total_amount,
                                price_clean, price_sales, sale_versi, no_invoice_sale, create_by, create_date, update_by, update_date) VALUES ('', '$ids', '$id_items', '$id_customer', '$id_sales', 
                                '$date', '$selling_amount',  '$total_amount', '$price_clean', '$selling_price_sales', '$sale_versi', '$no_invoice', '$username', '$date', null, null)");
            
            if($insert == false){
                return $this->msg->Error("Gagal menambahkan penjualan baru");
            }

            $update = mysqli_query($this->server->mysql, "UPDATE items SET quantity = '$value', update_by = '$username', update_date = '$date' WHERE id_item = '$id_items'");

            if($update == false){
                return $this->msg->Error("Gagal mengupdate stock");
            }

            // DELETE CART
            $delete = mysqli_query($this->server->mysql, "DELETE FROM cart_sale WHERE id_cart = '$id_items' AND session_cart = '$username'");
            if($delete == false){
                return $this->msg->Error("Gagal hapus session data penjualan");
            }

            // SCHEDULE MONTH
            // $schedule = mysqli_query($this->server->mysql, "SELECT * FROM profit WHERE MONTH(create_date) = '$month'");
            // $num_schedule = mysqli_num_rows($schedule);

            // if($tgl_terakhir === $date){

            //     if($num_schedule == 1 || $num_schedule > 1){

            //         $cek_pendapatan_profit = mysqli_query($this->server->mysql, "SELECT * FROM profit WHERE id_sales = '$id_sales'");
            //         $array = mysqli_fetch_array($cek_pendapatan_profit);

            //         // JIKA PENDAPATAN 5JT ATAU LEBIH -> DIBAGI 35%
            //         if((int) $array['profit'] == 5000000 || (int)$array['profit'] > 5000000){

            //             $sumMax = (int) $array['profit'] / 100 * 35;
            //             $total_pendapatan_sales = (int) $sumMax -  (int) $array['potongan_sales'];

            //             $updateMax = mysqli_query($this->server->mysql, "UPDATE profit SET profit = '$sumMax', total_pendapatan_sales = '$total_pendapatan_sales' WHERE id_sales = '$id_sales'");
            //             if($updateMax == false){
            //                 return $this->msg->Error("Gagal update profit pendapatan lebih dari 5jt");
            //             }

            //         }else{

            //             // JIKA KURANG DARI 5 JT -> DIBAGI 30%
            //             $sumMin = (int) $array['profit'] / 100 * 30;
            //             $total_pendapatan_saless = (int)$sumMin -  (int)$array['potongan_sales'];
            //             $updateMin = mysqli_query($this->server->mysql, "UPDATE profit SET profit = '$sumMin', total_pendapatan_sales = '$total_pendapatan_saless' WHERE id_sales = '$id_sales'");
            //             if($updateMin == false){
            //                 return $this->msg->Error("Gagal update profit pendapatan kurang dari 5jt");
            //             }
            //         }

            //         $update_schedule = mysqli_query($this->server->mysql, "UPDATE profit SET final_date = '$date' WHERE MONTH(create_date) = '$month'");
            //         if($update_schedule == false){
            //             $this->msg->Error("Gagal mengupdate profit per bulan");
            //         }

            //     }

            // }

            // CEK PROFIT ID SALES
            $cek_profit = mysqli_query($this->server->mysql, "SELECT * FROM profit WHERE id_sales = '$id_sales' AND MONTH(create_date) = '$month'");
            $num = mysqli_num_rows($cek_profit);
            $rows = mysqli_fetch_array($cek_profit);

            if($num == 1){

                $plus = (int) $selling_amount * $profit;
                $sum = $rows['profit'] + $plus;

                $update_profit = mysqli_query($this->server->mysql, "UPDATE profit SET profit = '$sum', update_by = '$username', update_date = '$date' WHERE id_sales = '$id_sales'");
                if($update_profit == false){
                    return $this->msg->Error("update profit dihari yang sama tidak berhasil");
                }

            }else{

                $plus = (int) $selling_amount * $profit;
                $insert_profit = mysqli_query($this->server->mysql, "INSERT INTO profit (id, id_profit, id_sales, profit, potongan_sales, total_pendapatan_sales, final_date, create_by, create_date, update_by, update_date)
                                VALUES ('', '$ids', '$id_sales', '$plus', '', '', null, '$username', '$date', null, null)");
                
                if($insert_profit == false){
                    return $this->msg->Error("Data profit gagal disimpan");
                }

            }
            
            return $this->msg->Success('Data penjualan berhasil disimpan');
        }
    }

    public function ViewTransaksiAll(){
        $all = mysqli_query($this->server->mysql, "SELECT SUM(total_amount) AS total_penjualan FROM sale");
        $data = mysqli_fetch_array($all);
        return $data['total_penjualan'];
    }

    public function ViewTransaksiRange($tgl_mulai, $tgl_akhir){
        $all = mysqli_query($this->server->mysql, "SELECT SUM(total_amount) AS total_penjualan FROM sale WHERE sell_date >= '$tgl_mulai' AND sell_date <= '$tgl_akhir'");
        $data = mysqli_fetch_array($all);
        return $data['total_penjualan'];
    }

    public function Update($id, $username, $name_sales, $nohp, $email, $kota, $kode_pos, $alamat){
        
        $date = date('Y-m-d');

        $name = strtoupper($name_sales);
        $update = mysqli_query($this->server->mysql, "UPDATE sales SET name_sales = '$name', no_handphone = '$nohp', email = '$email', 
                              kota = '$kota', kode_pos = '$kode_pos', alamat = '$alamat',
                              update_date = '$date', update_by = '$username' WHERE id_sales = '$id'");

        if($update == false){
            return $this->msg->Error('QUERY SQL UPDATE');
        }

        return $this->msg->Success('Data pelanggan berhasil di update');
    }

    public function Delete($id){

        $delete = mysqli_query($this->server->mysql, "DELETE FROM sales WHERE id_sales = '$id'");

        if($delete == false){
            return $this->msg->Error($delete);
        }

        return $this->msg->Success('Data pelanggan berhasil dihapus');
    }
}