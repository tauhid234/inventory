    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');

        include('../../model/InvoiceModel.php');
        include('../../model/SaleModel.php');
        include('../../model/CustomerModel.php');
        include('../../model/SalesModel.php');
        
        $model = new InvoiceModel();
        $model_sale = new SaleModel;
        $model_sales = new SalesModel;
        $model_customer = new CustomerModel;
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
  include('../../controller/InvoiceController.php');
  $alert = "";

  $controller = new InvoiceController();
  $disable = "";

  if(isset($_GET['detail']) && isset($_GET['v'])){

      $no_invoice = $_GET['detail'];
      $versi = $_GET['v'];
      $data_invoice = $model->ViewNoInvoice($no_invoice, $versi);
      if($data_invoice[0]['tempo_date'] !== ''){
          $disable = 'disabled';
      }
      $sale = $model_sale->ViewSaleInvoice($no_invoice, $versi);

      $data_sales = $model_sales->ViewId($data_invoice[0]['id_sales_invoice']);
      $data_customer = $model_customer->ViewId($data_invoice[0]['id_customer_invoice']);
  }

  if(isset($_POST['submit'])){
      
      $username = $_SESSION['username'];
    //   $no_invoice = $_POST['no_invoice'];
      $tempo = $_POST['tanggal_jatuh_tempo'];

      $alert = $controller->UpdateTempoController($versi, $username, $tempo);
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
            <h1 class="m-0">Detail Data Invoice </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Invoice</a></li>
              <li class="breadcrumb-item">Data Invoice</li>
              <li class="breadcrumb-item active">Detail</li>
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
                                            <label>Tanggal Jatuh Tempo</label>
                                            <input type="number" hidden class="form-control" name="no_invoice" value="<?= $no_invoice; ?>">
                                            <input type="date" class="form-control" name="tanggal_jatuh_tempo" required>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php  ?>
                    <div class="row">
                    <div class="col-md-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    Detail Sales
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama Sales</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-muted"><?= $data_sales[0]['name_sales']; ?></label>
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
                                                <label class="text-muted"><?= $data_sales[0]['no_handphone_sales']; ?></label>
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
                                                <label class="text-muted"><?= $data_sales[0]['email_sales']; ?></label>
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
                                                <label class="text-muted"><?= $data_sales[0]['kode_pos_sales']; ?></label>
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
                                                <label class="text-muted"><?= $data_sales[0]['alamat_sales']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                    </div>
                    <!-- END COL 6 -->
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                Detail Pelanggan
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nama Pelanggan</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-muted"><?= $data_customer[0]['name_customer']; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nama Toko</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-muted"><?= $data_customer[0]['name_toko']; ?></label>
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
                                            <label class="text-muted"><?= $data_customer[0]['no_handphone_customer']; ?></label>
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
                                            <label class="text-muted"><?= $data_customer[0]['email_customer']; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nomor Toko</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-muted"><?= $data_customer[0]['nomor_toko']; ?></label>
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
                                            <label class="text-muted"><?= $data_customer[0]['kode_pos_customer']; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Alamat Toko</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-muted"><?= $data_customer[0]['alamat_toko']; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    </div>
                <!-- END ROW -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-warning">
                                <div class="card-header">
                                    Detail Barang Penjualan                  
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-striped bordered" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Tanggal Penjualan</th>
                                                        <th>Nama Barang</th>
                                                        <th>Nama Sales</th>
                                                        <th>Nama Pelanggan</th>
                                                        <th>Kuantitas</th>
                                                        <th>Harga Penjualan</th>
                                                        <th>Total Penjualan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; foreach($sale as $s) { ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $s['sell_date']; ?></td>
                                                        <td><?= $s['name_item']; ?></td>
                                                        <td><?= $s['name_sales']; ?></td>
                                                        <td><?= $s['name_customer']; ?></td>
                                                        <td><?= $s['selling_amount']; ?></td>
                                                        <td><?= $s['price_sales']; ?></td>
                                                        <td><?= $s['total_amount']; ?></td>
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
                        <button type="submit" name="submit" class="btn btn-block btn-primary" <?= $disable; ?>>Simpan Invoice</button>                    
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