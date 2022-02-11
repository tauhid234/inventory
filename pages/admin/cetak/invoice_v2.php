<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
if(!isset($_SESSION["username"])){
  header("Location:../../../pages/login.php");
}


    include('../../../model/CetakInvoiceModel.php');

    $model = new CetakInvoiceModel();

    if(isset($_GET['inv'])){
        $versi = $_GET['inv'];
        $data = $model->ViewId($versi);

        $num = 0;
        foreach($data as $r){
            $num += (int)$r['total_amount'];
        }
    }
?>

<html>
<head>
<title>BINTANG 89 - INVOICE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='shortcut icon' href='../../../dist/img/LOGO BINTANG 89.png'/>
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<style>
#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
padding-left:5px;
border: 1px solid black;
}



    @media print{
        @page {
        size: A5;
        }
        table { page-break-inside:auto }
    }

</style>
</head>
<body style='font-family:tahoma; font-size:8pt; height: 200px;'>
<center>
<table style='width:100%; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
<span style='font-size:20pt; margin-top: 20px;'><img src="../../../dist/img/LOGO BINTANG 89.png" width="25px"><b style="padding-top: 20px;"> Bintang 89</b></span></br></br>
<b>SUPPLIER : KUNCI, ENGSEL & HANDLE</b> </br>
<b>Office : Hp. 0813 8519 5406</b> </br>
<b>Jakarta Barat</b> </br>
<b>Sales : <?= $data[0]['name_sales']; ?></b></br>
<span style="font-size: 15px; font-weight: bold;">INVOICE <?= substr($data[0]['name_sales'], 0, 2); ?><?= $data[0]['no_invoice']; ?></span>  </br>
</td>
<td style='vertical-align:middle' width='30%' align='right'>
<b><span style='font-size:8pt'>Tanggal <?= $data[0]['sell_date']; ?></span></b></br>
<b>Pelanggan : <?= $data[0]['name_customer']; ?></b> </br>
<b><?= $data[0]['alamat_toko']; ?></b> </br>
<b><?= $data[0]['no_handphone_customer']; ?></b> </br>
<b>Nomor Toko : <?= $data[0]['nomor_toko']; ?></b>
</td>
</table>
<table cellspacing='0' style='width:100%; font-size:8pt; font-family:calibri;  border-collapse: collapse;'>
 
<tr align='center'>
<td width='10%' style="font-weight: bold; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black;">#</td>
<td width='20%' style="font-weight: bold; border-bottom: 1px solid black; border-top: 1px solid black;">Nama Barang Penjualan</td>
<td width='5%' style="font-weight: bold; border-bottom: 1px solid black; border-top: 1px solid black;">Jumlah</td>
<td width='13%' style="font-weight: bold; border-bottom: 1px solid black; border-top: 1px solid black;">Jenis Satuan</td>
<td width='15%' style="font-weight: bold; border-bottom: 1px solid black; border-top: 1px solid black;">Harga Barang</td>
<td width='13%' style="font-weight: bold; border-bottom: 1px solid black; border-top: 1px solid black; border-right: 1px solid black;">Total Harga</td>
</tr>

<?php $i = 1; foreach($data as $d){ ?>
<tr>
    <td style="font-weight: bold; text-align: center; border-left: 1px solid black;" class="qty"><?= $i++; ?></td>
    <td class="text-left">
        <h3 style="font-weight: bold; color: black;"><?= $d['name_item']; ?></h3></td>
    <td style="font-weight: bold; text-align: center" class="qty"><?= $d['selling_amount']; ?></td>
    <td style="font-weight: bold; text-align: center" class="qty"><?= $d['unit_type']; ?></td>
    <td style="font-weight: bold; text-align: right;" class="qty"><?= $d['price_sales']; ?> </td>
    <td style="font-weight: bold; text-align: right; border-right: 1px solid black;" class="qty"><?= $d['total_amount']; ?> </td>
</tr>
<?php } ?>
<td colspan = '5' style="border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black;"><div style='text-align:right'><b>Total Keseluruhan </b></div></td>
<td style='text-align:right; border-bottom: 1px solid black; border-top: 1px solid black; border-right: 1px solid black;'><b><?= $num; ?></b></td>
</tr>
</table>
 
<table style='width:650; font-size:7pt;' cellspacing='2'>
<tr>
<td align='center'></br></br></br>Admin</br>
<!-- </br><u>(.....................................................)</u></td> -->
<!-- <td style='border:1px solid black; padding:5px; text-align:left; width:30%'></td> -->
<td align='center'></br></br></br>Pelanggan</br>
<!-- </br><u>(.....................................................)</u></td> -->
</tr>
</table>
</center>
</body>
<script>
    window.print();
</script>
</html>