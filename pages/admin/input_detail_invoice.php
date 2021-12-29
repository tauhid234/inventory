    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');
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
  include('../../controller/SaleController.php');
  include('../../controller/InvoiceController.php');

  $alert = "";
  $value = "";
  $disable = "";

  $controller_sale = new SaleController();
  $controller_invoice = new InvoiceController();

  $hari_ini = date("Y-m-d");

  if(isset($_GET['item'])){
      $id = $_GET['item'];
      $data = $controller_sale->ViewIdController($id);
  }

  if(isset($_POST['submit'])){

    $username = $_SESSION['username'];

    $id_sale = $_POST['id_sale'];
    $tempo = $_POST['tanggal_jatuh_tempo'];

    $disable = "disabled";
    $alert = $controller_invoice->AddController($username, $id_sale, $tempo, 'UNPAID');



  }

  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Input Invoice</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Invoice</a></li>
            <li class="breadcrumb-item active">Input Invoice</li>
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
              <form method="post" action="">
                              <div class="row">
                                <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                    </div>
                                    <!-- /.card-header -->
                                      <div class="card-body">
                                              <div class="row">
                                                  <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nama Pelanggan</label>
                                                        <input type="text" class="form-control" hidden name="id_sale" value="<?= $data[0]['id_selling_items']; ?>">
                                                        <select class="form-control" name="id_customer" disabled>
                                                            <option value="<?= $data[0]['id_customer']; ?>"><?= $data[0]['name_customer']; ?></option>
                                                        </select>
                                                    </div>
                                                  </div>
                                                  <div class="col-sm-6">
                                                    <div class="form-group">
                                                      <label>Tanggal Penjualan</label>
                                                      <input type="date" readonly class="form-control" name="tanggal_penjualan" value="<?= $data[0]['sell_date']; ?>">
                                                    </div>
                                                  </div>
                                                  <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nama Sales </label>
                                                        <select class="form-control" name="id_sales" disabled>
                                                            <option value="<?= $data[0]['id_sales']; ?>"><?= $data[0]['name_sales']; ?></option>
                                                        </select>
                                                    </div>
                                                  </div>
                                                  <div class="col-sm-6">
                                                    <div class="form-group">
                                                      <label>Tanggal Jatuh Tempo</label>
                                                      <input type="date" class="form-control" name="tanggal_jatuh_tempo" required>
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
                                  <div class="card card-primary">
                                    <div class="card-header">
                                        Detail Barang Penjualan                   
                                    </div>
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Nama Barang</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="text" class="form-control" readonly name="nama_barang" value="<?= $data[0]['name_item']; ?>">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Ukuran</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="text" class="form-control" readonly name="ukuran" value="<?= $data[0]['size']; ?>">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Jenis Ukuran</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="text" class="form-control" readonly name="jenis_ukuran" value="<?= $data[0]['size_type']; ?>">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Stock</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                              <?php if($value == ""){ ?>
                                            <input type="text" class="form-control" readonly id="stock" name="stock" value="<?= $data[0]['quantity']; ?>">
                                            <?php }else{ ?>
                                            <input type="text" class="form-control" readonly id="stock" name="stock" value="<?= $value; ?>">
                                            <?php } ?>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Jenis Satuan</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="text" class="form-control" readonly name="jenis_satuan" value="<?= $data[0]['unit_type']; ?>">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Harga Jual</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="number" class="form-control" readonly id="harga_jual" name="harga_jual" value="<?= $data[0]['price_sales']; ?>">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Jumlah Jual</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="number" class="form-control" readonly value="<?= $data[0]['selling_amount']; ?>">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <hr>
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Total Harga</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="number" class="form-control" value="<?= $data[0]['total_amount']; ?>" readonly>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="card-footer">
                                      <button type="submit" name="submit" class="btn btn-block btn-primary" <?= $disable; ?>>Simpan Invoice</button>                    
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
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
