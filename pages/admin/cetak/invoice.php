<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location:../../../pages/login.php");
}


    include('../../../model/CetakInvoiceModel.php');

    $model = new CetakInvoiceModel();

    if(isset($_GET['inv'])){
        $id = $_GET['inv'];
        $data = $model->ViewId($id);
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
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <a href="javascript:;">
    												<img src="assets/images/logo-icon.png" width="80" alt="">
												</a>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                                        <a href="#">
									BINTANG 89
									</a>
                                    </h2>
                                    <!-- <div>455 Foggy Heights, AZ 85004, US</div>
                                    <div>(123) 456-789</div>
                                    <div>company@example.com</div> -->
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">SALES :</div>
                                    <h2 class="to"><?= $data[0]['name_sales']; ?></h2>
                                    <div class="address"><?= $data[0]['alamat_sales']; ?></div>
                                    <div class="email"><a href="mailto:<?=$data[0]['email_sales']; ?>"><?= $data[0]['email_sales'];?></a>
                                    </div>
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">INVOICE <?= $data[0]['no_invoice']; ?></h1>
                                    <div class="text-gray-light">CUSTOMER :</div>
                                    <h2 class="to"><?= $data[0]['name_customer']; ?></h2>
                                    <div class="address"><?= $data[0]['alamat_toko']; ?></div>
                                    <div class="address"><b>Nomor Toko : </b><?= $data[0]['nomor_toko']; ?></div>
                                    <div class="email mb-4"><a href="mailto:<?=$data[0]['email_customer']; ?>"><?= $data[0]['email_customer'];?></a>
                                </div>
                            </div>
                            <table>
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
                                    <tr>
                                        <td class="no">01</td>
                                        <td class="text-left">
                                            <h3><?= $data[0]['name_item']; ?></h3></td>
                                        <td class="qty"><?= $data[0]['selling_amount']; ?></td>
                                        <td class="qty"><?= $data[0]['unit_type']; ?></td>
                                        <td class="total"><?= $data[0]['selling_price']; ?></td>
                                    </tr>
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
                                        <td><?= $data[0]['total_amount']; ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- <div class="thanks mt-4">Thank you!</div> -->
                            <!-- <div class="notices">
                                <div>NOTICE:</div>
                                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                            </div> -->
                                <div class="col invoice-to">
                                    <hr style="margin-top: 150px; width : 300px">
                                        <div class="ext-gray-light text-center" style="margin-top: 10px;"><?= $data[0]['name_sales'];?>
                                    </div>
                                </div>
                                <div class="col invoice-details">
                                    <hr style="margin-top: 150px; width : 300px">
                                        <div class="ext-gray-light text-center" style="margin-top: 10px;"><?= $data[0]['name_customer'];?>
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