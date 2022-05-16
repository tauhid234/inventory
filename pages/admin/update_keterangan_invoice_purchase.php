    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');

        include('../../model/InvoicePembelianModel.php');
        include('../../model/PurchaseModel.php');
        include('../../model/SuplierModel.php');
        
        $model = new InvoicePembelianModel;
        $model_purchase = new PurchaseModel;
        $model_suplier = new SuplierModel;
    ?>
    <!-- END HEADER -->

  <!-- NAVBAR -->
    <?php 
    include('../../component_temp/navbar.php');
    ?>
  <!-- END NAVBAR -->
    
  <!-- SIDEBAR -->
    <?php 
    include('../../component_temp/sidebar.php');
    ?>
  <!-- END SIDEBAR -->

  <?php
  include('../../controller/InvoicePurchaseController.php');
  $alert = "";

  $controller = new InvoicePurchaseController;
  $disable = "";

  if(isset($_GET['detail']) && isset($_GET['v'])){

      $no_invoice = $_GET['detail'];
      $versi = $_GET['v'];
      $data_invoice = $model->ViewNoInvoice($no_invoice, $versi);
      $purchase = $model->ViewPurchaseInvoiceProduct($no_invoice, $versi);

    //   $num = 0;
    //   foreach($sale as $test){
    //       $num += $test['total_amount'];
    //   }
    //   echo $num;

      $data_suplier = $model_suplier->ViewId($data_invoice[0]['id_suplier_invoice']);
  }

  if(isset($_POST['update'])){
      
      $username = $_SESSION['username'];
      $no_invoice = $_POST['no_invoice'];
      $status_bayar = $_POST['status_bayar'];
      $keterangan = $_POST['keterangan'];
      $versioning = $_POST['versioning'];
      $alert = $controller->UpdatePembayaranController($no_invoice, $username, $status_bayar, $keterangan, $versioning);
      $disable = "disabled";

  }


  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Update Keterangan Invoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Invoice</a></li>
              <li class="breadcrumb-item">Data Invoice</li>
              <li class="breadcrumb-item active">Update Keterangan Invoice</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <?= $alert; ?> 
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header">
                  Detail Invoice
                </div>
              <!-- /.card-header -->
              <div class="card-body">

                    <!-- MODAL -->
             <form method="post" action="">
                <div class="modal-body">
                    <?php ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-primary">
                                <div class="card-header">

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Status Bayar</label>
                                                <input type="text" hidden name="versioning" value="<?= $data_invoice[0]['purchase_versi_invoice']; ?>" class="form-control">
                                                <input type="text" readonly name="status_bayar" value="<?= $data_invoice[0]['status_pay'];?>" class="form-control">
                                                <input type="text" hidden class="form-control" name="no_invoice" value="<?= $no_invoice; ?>">
                                                <!-- <select class="form-control" name="status_bayar" required> 
                                                    <option value="">-PILIH-</option>
                                                    <option value="PAID">BAYAR</option>
                                                </select> -->
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Keterangan <span style="color: red;">*</span></label>
                                                    <input type="text" name="keterangan" value="<?= $data_invoice[0]['keterangan_purchase'];?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php  ?>
                    <div class="row">
                    <div class="col-md-12">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    Detail Suplier
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama Suplier</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-muted"><?= $data_suplier[0]['name_suplier']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>No. Handphone</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-muted"><?= $data_suplier[0]['no_handphone_suplier']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-muted"><?= $data_suplier[0]['email_suplier']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Kode Pos</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-muted"><?= $data_suplier[0]['kode_pos_suplier']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-muted"><?= $data_suplier[0]['alamat_suplier']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                    </div>
                    <!-- END COL 12 -->
                    </div>
                <!-- END ROW -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-warning">
                                <div class="card-header">
                                    Detail Barang Pembelian                  
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-striped bordered" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Tanggal Pembelian</th>
                                                        <th>Nama Barang</th>
                                                        <th>Nama Suplier</th>
                                                        <th>Kuantitas</th>
                                                        <th>Harga Pembelian</th>
                                                        <th>Total Pembelian</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; foreach($purchase as $ps) { ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $ps['create_date'];?></td>
                                                        <td><?= $ps['name_item']; ?></td>
                                                        <td><?= $ps['name_suplier']; ?></td>
                                                        <td><?= $ps['purchase_amount']; ?></td>
                                                        <td><?= $ps['purchase_price']; ?></td>
                                                        <td><?= $ps['total_amount']; ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" name="update" class="btn btn-block btn-primary" <?= $disable; ?>>Simpan Perubahan Keterangan</button>                    
                    </div>
                </form>
              </div>
            </div>
          </div>  
        </div>      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- FOOTER -->
    <?php
    include('../../component_temp/footer.php');
    ?>
  <!-- END FOOTER -->