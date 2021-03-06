<?php 
require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');
require_once('../../util/UUID.php');

class ReturModel{

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
        $date = date('Y-m-d');
        $data = mysqli_query($this->server->mysql, "SELECT retur.*, sale.*, items.*, sales.*, customer.* FROM retur,sale,items,sales,customer WHERE retur.id_sale_retur = sale.id_selling_items
                            AND sale.id_items = items.id_item AND sale.id_sales = sales.id_sales AND sale.id_customer = customer.id_customer AND retur.retur_date = '$date'");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function ViewCustom($tgl_mulai, $tgl_akhir, $id_sales, $id_customer){
        $data = mysqli_query($this->server->mysql, "SELECT retur.*, sale.*, items.*, sales.*, customer.* FROM retur,sale,items,sales,customer WHERE retur.id_sale_retur = sale.id_selling_items
                            AND sale.id_items = items.id_item AND sale.id_sales = '$id_sales' AND sale.id_customer = '$id_customer' AND retur.retur_date >= '$tgl_mulai' AND retur.retur_date <= '$tgl_akhir'");
        while($d = mysqli_fetch_array($data)){
            $this->output[] = $d;
        }
        return $this->output;
        mysqli_close($this->server->mysql);
    }

    public function AddRetur($id_sale, $id_sales, $id_customer, $retur_amount, $username, $versi_sale, $sale_invoice, $potongan){

        $date = date('Y-m-d');
        $m = date('m');
        $ids = $this->uid->guidv4();
        $total = 0;

        $cek_sale = mysqli_query($this->server->mysql, "SELECT * FROM sale WHERE id_selling_items = '$id_sale'");
        $num_rows1 = mysqli_num_rows($cek_sale);
        $array = mysqli_fetch_array($cek_sale);

        if($num_rows1 == 1){

                $cek_invoice = mysqli_query($this->server->mysql, "SELECT * FROM invoice WHERE status_pay = 'UNPAID' AND sale_versi_invoice = '$versi_sale'");
                $num_ = mysqli_num_rows($cek_invoice);

                // UNTUK DATA INVOICE YANG MASIH DALAM TEMPO DAN BELUM LUNAS -> MAKA POTONG PELANGGAN DAN SALES
                if($num_ != 0){
                    
                    // echo (int)$array['price_sales'] * (int)$retur_amount;
                    // $potongan_pelanggan = $array['total_amount'] / $retur_amount;

                    $potongan_pelanggan = (int)$array['price_sales'] * (int)$retur_amount;
                    $pengurangan_pembelian_pelanggan = (int)$array['selling_amount'] - (int)$retur_amount;

                    $pp = (int)$pengurangan_pembelian_pelanggan * (int)$array['price_sales'];

                    $update_sale = mysqli_query($this->server->mysql, "UPDATE sale SET update_by = '$username', update_date = '$date', selling_amount = '$pengurangan_pembelian_pelanggan',
                                   total_amount = '$pp' WHERE id_selling_items = '$id_sale'");
                    
                    if($update_sale == false){
                        return $this->msg->Error("Gagal membuat potongan kepada pelanggan");
                    }


                    // INSERT POTONGAN TIDAK JADI -> JADINYA LANGSUNG INSERT KE DATA RETUR

                    // $potongan_sales = mysqli_query($this->server->mysql, "SELECT id_sales, potongan, create_date FROM potongan WHERE id_sales = '$id_sales' AND MONTH(create_date) = '$m'");
                    // $num = mysqli_num_rows($potongan_sales);
                    // $arrays = mysqli_fetch_array($potongan_sales);

                    
                    // if($num == 1){
                    //     $sum = (int)$arrays['potongan'] + (int)$potongan;
                    //     $update = mysqli_query($this->server->mysql, "UPDATE potongan SET potongan = '$sum', update_by = '$username', update_date = '$date' WHERE id_sales = '$id_sales'");
                    //     if($update == false){
                    //         return $this->msg->Error("Gagal update potongan sales");
                    //     }
                    // }else{

                    //     $insert = mysqli_query($this->server->mysql, "INSERT INTO potongan (id, id_potongan, id_sales, potongan, create_by, create_date, update_by, update_date)
                    //                         VALUES ('', '$ids', '$id_sales', '$potongan', '$username', '$date', null, null)");
                        
                    //     if($insert == false){
                    //         return $this->msg->Error("Gagal menambahkan data baru potongan sales");
                    //     }
                    // }

                }
                else{

                    // UNTUK INVOICE TRANSAKSI YANG SUDAH SELESAI -> HANYA POTONG SALES
                    // ------------------------------------------------------------------------------------------------------
                    // INSERT POTONGAN TIDAK JADI -> JADINYA LANGSUNG INSERT KE DATA RETUR
                    
                    // $potongan_sales = mysqli_query($this->server->mysql, "SELECT id_sales, potongan, create_date FROM potongan WHERE id_sales = '$id_sales' AND MONTH(create_date) = '$m'");
                    // $num = mysqli_num_rows($potongan_sales);

                    
                    // if($num == 1){
                    //     $arrays = mysqli_fetch_array($potongan_sales);
                    //     $sum = (int)$arrays['potongan'] + (int)$potongan;
                    //     $update = mysqli_query($this->server->mysql, "UPDATE potongan SET potongan = '$sum', update_by = '$username', update_date = '$date' WHERE id_sales = '$id_sales'");
                    //     if($update == false){
                    //         return $this->msg->Error("Gagal update potongan sales");
                    //     }
                    // }else{

                    //     $insert = mysqli_query($this->server->mysql, "INSERT INTO potongan (id, id_potongan, id_sales, potongan, create_by, create_date, update_by, update_date)
                    //                         VALUES ('', '$ids', '$id_sales', '$potongan', '$username', '$date', null, null)");
                        
                    //     if($insert == false){
                    //         return $this->msg->Error("Gagal menambahkan data baru potongan sales");
                    //     }
                    // }

                }
        }


        $get_data_invoice_retur = mysqli_query($this->server->mysql, "SELECT COUNT(id_sales_invoice_retur) AS total FROM invoice_retur WHERE id_sales_invoice_retur = '$id_sales'");
        $data = mysqli_fetch_assoc($get_data_invoice_retur);
        if($get_data_invoice_retur == false){
            return $this->msg->Error("Gagal mengambil data nomor invoice retur count sales");
        }

        if($data['total'] == 0){
           $total =  1;
        }else{
           $total = (int)$data['total'] + 1;
        }

        $sum = '00'.(string)$total;
        $no_invoice = sprintf("%03d", $sum);

        $cek_duplicate = mysqli_query($this->server->mysql, "SELECT * FROM invoice_retur WHERE sale_versi_invoice_retur = '$versi_sale'");
        $rows = mysqli_num_rows($cek_duplicate);

        if($rows == 0){

            $insert = mysqli_query($this->server->mysql, "INSERT INTO invoice_retur (id, id_invoice_retur, no_invoice_retur, sale_invoice_retur, sale_versi_invoice_retur,
                            id_sales_invoice_retur, id_customer_invoice_retur, create_by, create_date, update_by, update_date) VALUES ('', '$ids', '$no_invoice', '$sale_invoice', 
                            '$versi_sale', '$id_sales', '$id_customer', '$username', '$date', null, null)");
        
            if($insert == false){
                return $this->msg->Error("Gagal menambahkan invoice retur");
            }
        
            // return $this->msg->Success('Data invoice berhasil disimpan');

        }

        
        $potongan_pelanggan = (int)$array['price_sales'] * (int)$retur_amount;

        $insert = mysqli_query($this->server->mysql, "INSERT INTO retur (id, id_retur, no_invoice, id_sale_retur, sale_versi_retur, retur_date, retur_amount, total_potongan, create_by,
                                create_date, update_by, update_date) VALUES ('', '$ids', '$no_invoice', '$id_sale', '$versi_sale', '$date', '$retur_amount', '$potongan_pelanggan', '$username',
                                '$date', null, null)");
        
        if($insert == false){
            return $this->msg->Error("Gagal menyimpan data retur");
        }


        // GET ITEM
        $id_item = $array['id_items'];
        $get_item = mysqli_query($this->server->mysql, "SELECT * FROM items WHERE id_item = '$id_item'");
        $array_item = mysqli_fetch_array($get_item);

        // CALCULATE
        $calculate = (int) $array['price_sales'] - (int) $array_item['selling_price'];
        $totals = (int) $calculate * (int) $retur_amount;
        echo $totals;

        // ADD REPORT POTONGAN SALES PER ITEM
        $report_profit_sales = mysqli_query($this->server->mysql, "INSERT INTO report_potongan_sales (id, id_report_potongan_sales, id_sales_report, id_customer_report, id_items_report, potongan, create_by, create_date,
        update_by, update_date) VALUES ('', '$ids', '$id_sales', '$id_customer', '$id_item', '$totals', '$username', '$date', null, null)");

        if($report_profit_sales == false){
        return $this->msg->Error("insert report potongan sales gagal");
        }

        // GET PROFIT
        $get_profit = mysqli_query($this->server->mysql, "SELECT * FROM profit WHERE id_sales = '$id_sales'");
        $rows_p = mysqli_num_rows($get_profit);
        $array_p = mysqli_fetch_array($get_profit);

        $sum_ = 0;
        $sum_s = 0;

        if($rows_p == 1){

            // RUMUS POTONGAN SALES = TOTAL POTONGAN PENJUALAN - PROFIT
            // MENGHINDARI MINUS

            // if((int) $potongan > (int) $array_p['profit']){

            //     $sum_ = (int)$potongan - (int)$array_p['profit'];

            //     // JIKA SUDAH ADA JUMLAH POTONGAN SEBELUMNYA MAKA AKAN DITAMBAH DENGAN YANG BARU
            //     $sum_s = (int)$sum_ + (int)$array_p['potongan_sales'];

            // }else if((int) $potongan < (int) $array_p['profit']){

            //     $sum_ = (int)$array_p['profit'] - (int)$potongan;

            //     // JIKA SUDAH ADA JUMLAH POTONGAN SEBELUMNYA MAKA AKAN DITAMBAH DENGAN YANG BARU
            //     $sum_s = (int)$sum_ + (int)$array_p['potongan_sales'];

            // } 

            // UPDATE PROFIT

            $plus_exist_potongan = (int)$array_p['potongan_sales'] + (int)$totals;
            $update_profit = mysqli_query($this->server->mysql, "UPDATE profit SET potongan_sales = '$plus_exist_potongan' WHERE id_sales = '$id_sales'");
            if($update_profit == false){
                return $this->msg->Error("Data potongan sales gagal dikalkulasikan");
            }

        }

        // UPDATE ITEMS
        $id_item = $array['id_items'];
        $cek_items = mysqli_query($this->server->mysql, "SELECT * FROM items WHERE id_item = '$id_item'");
        $array_item = mysqli_fetch_array($cek_items);

        $total_stock = (int) $array_item['quantity'] + (int)$retur_amount;
        $update_stock = mysqli_query($this->server->mysql, "UPDATE items SET quantity = '$total_stock' WHERE id_item = '$id_item'");

        if($update_stock == false){
            return $this->msg->Error("Data stock gagal diupdate setelah retur barang");
        }

        return $this->msg->Success("Data retur berhasil disimpan");
        
    }


    public function AddReturV2($id_sale, $id_sales, $id_customer, $retur_amount, $username, $versi_sale, $sale_invoice, $potongan){

        $date = date('Y-m-d');
        $m = date('m');
        $ids = $this->uid->guidv4();
        $total = 0;

        $cek_sale = mysqli_query($this->server->mysql, "SELECT * FROM sale WHERE id_selling_items = '$id_sale'");
        $num_rows1 = mysqli_num_rows($cek_sale);
        $array = mysqli_fetch_array($cek_sale);

        if($num_rows1 == 1){

                $cek_invoice = mysqli_query($this->server->mysql, "SELECT * FROM invoice WHERE status_pay = 'UNPAID' AND sale_versi_invoice = '$versi_sale'");
                $num_ = mysqli_num_rows($cek_invoice);

                // UNTUK DATA INVOICE YANG MASIH DALAM TEMPO DAN BELUM LUNAS -> MAKA POTONG PELANGGAN DAN SALES
                if($num_ != 0){
                    
                    // echo (int)$array['price_sales'] * (int)$retur_amount;
                    // $potongan_pelanggan = $array['total_amount'] / $retur_amount;

                    $potongan_pelanggan = (int)$array['price_sales'] * (int)$retur_amount;
                    $pengurangan_pembelian_pelanggan = (int)$array['selling_amount'] - (int)$retur_amount;

                    $pp = (int)$pengurangan_pembelian_pelanggan * (int)$array['price_sales'];

                    $update_sale = mysqli_query($this->server->mysql, "UPDATE sale SET update_by = '$username', update_date = '$date', selling_amount = '$pengurangan_pembelian_pelanggan',
                                   total_amount = '$pp' WHERE id_selling_items = '$id_sale'");
                    
                    if($update_sale == false){
                        return $this->msg->Error("Gagal membuat potongan kepada pelanggan");
                    }


                    // INSERT POTONGAN TIDAK JADI -> JADINYA LANGSUNG INSERT KE DATA RETUR

                    // $potongan_sales = mysqli_query($this->server->mysql, "SELECT id_sales, potongan, create_date FROM potongan WHERE id_sales = '$id_sales' AND MONTH(create_date) = '$m'");
                    // $num = mysqli_num_rows($potongan_sales);
                    // $arrays = mysqli_fetch_array($potongan_sales);

                    
                    // if($num == 1){
                    //     $sum = (int)$arrays['potongan'] + (int)$potongan;
                    //     $update = mysqli_query($this->server->mysql, "UPDATE potongan SET potongan = '$sum', update_by = '$username', update_date = '$date' WHERE id_sales = '$id_sales'");
                    //     if($update == false){
                    //         return $this->msg->Error("Gagal update potongan sales");
                    //     }
                    // }else{

                    //     $insert = mysqli_query($this->server->mysql, "INSERT INTO potongan (id, id_potongan, id_sales, potongan, create_by, create_date, update_by, update_date)
                    //                         VALUES ('', '$ids', '$id_sales', '$potongan', '$username', '$date', null, null)");
                        
                    //     if($insert == false){
                    //         return $this->msg->Error("Gagal menambahkan data baru potongan sales");
                    //     }
                    // }

                }
        }


        $get_data_invoice_retur = mysqli_query($this->server->mysql, "SELECT COUNT(id_sales_invoice_retur) AS total FROM invoice_retur WHERE id_sales_invoice_retur = '$id_sales'");
        $data = mysqli_fetch_assoc($get_data_invoice_retur);
        if($get_data_invoice_retur == false){
            return $this->msg->Error("Gagal mengambil data nomor invoice retur count sales");
        }

        if($data['total'] == 0){
           $total =  1;
        }else{
           $total = (int)$data['total'] + 1;
        }

        $sum = '00'.(string)$total;
        $no_invoice = sprintf("%03d", $sum);

        $cek_duplicate = mysqli_query($this->server->mysql, "SELECT * FROM invoice_retur WHERE sale_versi_invoice_retur = '$versi_sale'");
        $rows = mysqli_num_rows($cek_duplicate);

        if($rows == 0){

            $insert = mysqli_query($this->server->mysql, "INSERT INTO invoice_retur (id, id_invoice_retur, no_invoice_retur, sale_invoice_retur, sale_versi_invoice_retur,
                            id_sales_invoice_retur, id_customer_invoice_retur, create_by, create_date, update_by, update_date) VALUES ('', '$ids', '$no_invoice', '$sale_invoice', 
                            '$versi_sale', '$id_sales', '$id_customer', '$username', '$date', null, null)");
        
            if($insert == false){
                return $this->msg->Error("Gagal menambahkan invoice retur");
            }
        
            // return $this->msg->Success('Data invoice berhasil disimpan');

        }

        
        $potongan_pelanggan = (int)$array['price_sales'] * (int)$retur_amount;

        $insert = mysqli_query($this->server->mysql, "INSERT INTO retur (id, id_retur, no_invoice, id_sale_retur, sale_versi_retur, retur_date, retur_amount, total_potongan, create_by,
                                create_date, update_by, update_date) VALUES ('', '$ids', '$no_invoice', '$id_sale', '$versi_sale', '$date', '$retur_amount', '$potongan_pelanggan', '$username',
                                '$date', null, null)");
        
        if($insert == false){
            return $this->msg->Error("Gagal menyimpan data retur");
        }


        // GET ITEM
        $id_item = $array['id_items'];
        $get_item = mysqli_query($this->server->mysql, "SELECT * FROM items WHERE id_item = '$id_item'");
        $array_item = mysqli_fetch_array($get_item);

        // CALCULATE
        $calculate = (int) $array['price_sales'] - (int) $array_item['selling_price'];
        $totals = (int) $calculate * (int) $retur_amount;
        echo $totals;

        // ADD REPORT POTONGAN SALES PER ITEM
        $report_profit_sales = mysqli_query($this->server->mysql, "INSERT INTO report_potongan_sales (id, id_report_potongan_sales, id_sales_report, id_customer_report, id_items_report, potongan, create_by, create_date,
        update_by, update_date) VALUES ('', '$ids', '$id_sales', '$id_customer', '$id_item', '$totals', '$username', '$date', null, null)");

        if($report_profit_sales == false){
        return $this->msg->Error("insert report potongan sales gagal");
        }

        // CEK PROFIT RETUR ID SALES
        $cek_profit_retur = mysqli_query($this->server->mysql, "SELECT * FROM profit_retur WHERE id_sales = '$id_sales' AND create_date = '$date' AND no_invoice_retur_profit = '$no_invoice'");
        $num = mysqli_num_rows($cek_profit_retur);
        $rows = mysqli_fetch_array($cek_profit_retur);

        if($num == 1){

            $update_profit_retur = mysqli_query($this->server->mysql, "UPDATE profit_retur SET profit_retur = '$totals', update_by = '$username', update_date = '$date' WHERE id_sales = '$id_sales' AND create_date = '$date' AND no_invoice_retur_profit = '$no_invoice'");
            if($update_profit_retur == false){
                return $this->msg->Error("update profit retur dihari yang sama tidak berhasil");
            }

        }else{

            $insert_profit = mysqli_query($this->server->mysql, "INSERT INTO profit_retur (id, id_profit_retur, id_sales, profit_retur, potongan_sales, total_pendapatan_sales, final_date, create_by, create_date, update_by, update_date, no_invoice_retur_profit)
                            VALUES ('', '$ids', '$id_sales', '$totals', '', '', null, '$username', '$date', null, null, '$no_invoice')");
            
            if($insert_profit == false){
                return $this->msg->Error("Data profit retur gagal disimpan");
            }

        }

        // UPDATE ITEMS
        $id_item = $array['id_items'];
        $cek_items = mysqli_query($this->server->mysql, "SELECT * FROM items WHERE id_item = '$id_item'");
        $array_item = mysqli_fetch_array($cek_items);

        $total_stock = (int) $array_item['quantity'] + (int)$retur_amount;
        $update_stock = mysqli_query($this->server->mysql, "UPDATE items SET quantity = '$total_stock' WHERE id_item = '$id_item'");

        if($update_stock == false){
            return $this->msg->Error("Data stock gagal diupdate setelah retur barang");
        }

        return $this->msg->Success("Data retur berhasil disimpan");
        
    }
}
