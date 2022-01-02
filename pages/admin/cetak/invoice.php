<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
if(!isset($_SESSION["username"])){
  header("Location:../../../pages/login.php");
}


    include('../../../model/CetakInvoiceModel.php');

    $model = new CetakInvoiceModel();

    if(isset($_GET['inv'])){
        $no_invoice = $_GET['inv'];
        $data = $model->ViewId($no_invoice);

        $num = 0;
        foreach($data as $r){
            $num += $r['total_amount'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>BINTANG 89 - INVOICE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../dist/css/temp_invoice.css">
    <link rel='shortcut icon' href='../../../dist/img/LOGO BINTANG 89.png'/>
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div id="invoice">
                <!-- <div class="toolbar hidden-print">
                    <div class="text-end">
                        <button type="button" class="btn btn-dark"><i class="fa fa-print"></i> Print</button>
                        <button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                    </div>
                    <hr>
                </div> -->
                <div class="invoice overflow-auto">
                    <div style="min-width: 400px">
                        <header>
                            <div class="row contacts">
                                <div class="col invoice-to" style="color: #2980b9;">
                                    <h1 class="invoice-id mb-4"><img src="../../../dist/img/LOGO BINTANG 89.png" width="70px"> BINTANG 89</h1>
                                    <div class="invoice-id">SUPPLIER : KUNCI, ENGSEL & HANDLE</div>                                    
                                    <div class="invoice-id">Office : Hp. 0813 8519 5406</div>                                    
                                    <div class="invoice-id">Jakarta Barat</div>                       
                                    <h1 class="invoice-id">INVOICE <?= $data[0]['no_invoice']; ?></h1>             
                                </div>
                                <div class="col invoice-details" style="color: #2980b9;">
                                    <div class="text-gray-light mb-4">Tanggal : <?= date('Y-m-d'); ?></div>
                                    <div class="text-gray-light">CUSTOMER :</div>
                                        <h2 class="to"><?= $data[0]['name_customer']; ?></h2>
                                        <div class="address"><?= $data[0]['alamat_toko']; ?></div>
                                        <div class="address"><?= $data[0]['no_handphone_customer']; ?></div>
                                        <div class="address mb-4"><b>Nomor Toko : </b><?= $data[0]['nomor_toko']; ?></div>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col">
                                </div>
                                <div class="col company-details">
                                    <h2 class="name text-left" style="color: #2980b9;">
									    BINTANG 89
                                    </h2>
                                </div>
                            </div> -->
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to" style="color: #2980b9;">
                                    <!-- <h1 class="invoice-id">INVOICE <?= $data[0]['no_invoice']; ?></h1>
                                    <div class="text-gray-light">SALES :</div>
                                    <h2 class="to"><?= $data[0]['name_sales']; ?></h2>
                                    <div class="address"><?= $data[0]['alamat_sales']; ?></div>
                                    <div class="address mb-4"><?= $data[0]['no_handphone_sales']; ?></div>
                                    <div class="email"><a href="mailto:<?=$data[0]['email_sales']; ?>"><?= $data[0]['email_sales'];?></a>
                                    </div> -->
                                </div>
                                <div class="col invoice-details" style="color: #2980b9;">
                                    <!-- <h1 class="invoice-id">INVOICE <?= $data[0]['no_invoice']; ?></h1>
                                    <div class="text-gray-light">CUSTOMER :</div>
                                    <h2 class="to"><?= $data[0]['name_customer']; ?></h2>
                                    <div class="address"><?= $data[0]['alamat_toko']; ?></div>
                                    <div class="address"><?= $data[0]['no_handphone_customer']; ?></div>
                                    <div class="address mb-4"><b>Nomor Toko : </b><?= $data[0]['nomor_toko']; ?></div>
                                    <div class="email mb-4"><a href="mailto:<?=$data[0]['email_customer']; ?>"><?= $data[0]['email_customer'];?></a> -->
                                </div>
                            </div>
                            <table style="color: #2980b9;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">Nama Barang</th>
                                        <th class="text-right">Jumlah</th>
                                        <th class="text-right">Jenis Satuan</th>
                                        <th class="text-rigth">Harga Barang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; foreach($data as $d){ ?>
                                    <tr>
                                        <td class="no"><?= '0'.$i++; ?></td>
                                        <td class="text-left">
                                            <h3><?= $d['name_item']; ?></h3></td>
                                        <td class="qty"><?= $d['selling_amount']; ?></td>
                                        <td class="qty"><?= $d['unit_type']; ?></td>
                                        <td class="total"><?= $d['price_sales']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <!-- <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>$5,200.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">TAX 25%</td>
                                        <td>$1,300.00</td>
                                    </tr> -->
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">TOTAL</td>
                                        <td><?= $num; ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- <div class="thanks mt-4">Thank you!</div> -->
                            <!-- <div class="notices">
                                <div>NOTICE:</div>
                                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                            </div> -->
                                <div class="col invoice-to" style="color: #2980b9;">
                                    <hr style="margin-top: 250px; width : 300px; margin-left: 50px; border: 1px solid #2980b9;">
                                        <div class="ext-gray-light" style="margin-top: 10px; margin-left: 180px">Admin
                                    </div>
                                </div>
                                <div class="col invoice-details" style="color: #2980b9;">
                                    <hr style="margin-top: -40px; width : 300px; margin-right: 80px; border: 1px solid #2980b9;">
                                        <div class="ext-gray-light" style="margin-top: 10px; margin-right: 190px;">Customer
                                    </div>
                                </div>
                        </main>
                        <!-- <footer>Invoice was created on a computer and is valid without the signature and seal.</footer> -->
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    window.print();
</script>
</html>