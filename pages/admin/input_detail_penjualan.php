    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');

        include('../../model/ItemsModel.php');
        include('../../model/CustomerModel.php');
        include('../../model/SalesModel.php');
        
        $model = new ItemsModel();
        $model_customer = new CustomerModel();
        $model_sales = new SalesModel();
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
  include('../../controller/ItemsController.php');

  $alert = "";
  $value = "";

  $controller = new SaleController();
  $controller2 = new ItemsController();

  $hari_ini = date("Y-m-d");

  if(isset($_GET['item'])){
      $id = $_GET['item'];
      $data = $controller2->ViewIdController($id);
  }

  if(isset($_POST['submit'])){

    $id_items = $_POST['id_item'];
    $id_customer = $_POST['id_customer'];
    $id_sales = $_POST['id_sales'];
    $selling_amount = $_POST['jumlah_jual'];
    $total_amount = $_POST['total_harga'];

    // $purchase_price = $_POST['harga_beli'];

    $selling_price_admin = $_POST['harga_jual_admin'];
    $selling_price_sales = $_POST['harga_jual_sales'];

    // $price_clean = $selling_price - $purchase_price;
    $price_clean = $selling_price_sales - $selling_price_admin;




    $stock = $_POST['stock'];
    $value = $stock - $selling_amount;


    $username = $_SESSION['username'];

    

    $alert = $controller->AddController($id_items, $value, $id_customer, $id_sales, $selling_amount, $selling_price_sales, $selling_price_admin, $total_amount, $price_clean, $username);
  }

  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Input Penjualan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Penjualan</a></li>
            <li class="breadcrumb-item"><a href="#">Penjualan Baru</a></li>
            <li class="breadcrumb-item active">Input Penjualan</li>
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
                                <div class="card card-warning">
                                    <div class="card-header">
                                    </div>
                                    <!-- /.card-header -->
                                      <div class="card-body">
                                              <div class="row">
                                                  <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nama Pelanggan <span style="color: red;">*</span></label>
                                                        <select class="form-control" name="id_customer" required>
                                                          <option value="">-PILIH-</option>
                                                          <?php foreach($model_customer->View() as $mdl){ ?>
                                                            <option value="<?= $mdl['id_customer']; ?>"><?= $mdl['name_customer'];?></option>
                                                          <?php } ?>
                                                        </select>
                                                    </div>
                                                  </div>
                                                  <div class="col-sm-6">
                                                    <div class="form-group">
                                                      <label>Tanggal Penjualan</label>
                                                      <input type="date" readonly class="form-control" name="tanggal_penjualan" value="<?= $hari_ini; ?>">
                                                    </div>
                                                  </div>
                                                  <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nama Sales <span style="color: red;">*</span></label>
                                                        <select class="form-control" name="id_sales" required>
                                                          <option value="">-PILIH-</option>
                                                          <?php foreach($model_sales->View() as $mdl){ ?>
                                                            <option value="<?= $mdl['id_sales']; ?>"><?= $mdl['name_sales'];?></option>
                                                          <?php } ?>
                                                        </select>
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
                                        Detail Barang                    
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
                                            <input type="text" class="form-control" hidden name="id_item" value="<?= $data[0]['id_item']; ?>">
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
                                              <?php if($value == "" || $value == 0){ ?>
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
                                            <label>Harga Jual Admin</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <!-- <input type="text" class="form-control" hidden name="harga_beli" value="<?= $data[0]['purchase_price']; ?>"> -->
                                            <input type="number" class="form-control" readonly id="harga_jual_admin" name="harga_jual_admin" value="<?= $data[0]['selling_price']; ?>">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Harga Jual Sales</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="text" class="form-control" hidden name="harga_beli" value="<?= $data[0]['purchase_price']; ?>">
                                            <input type="number" class="form-control" id="harga_jual_sales" name="harga_jual_sales">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Jumlah Jual <span style="color: red;">*</span></label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="number" class="form-control"  id="jumlah_jual" onkeyup="sumTotal()" name="jumlah_jual" required>
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
                                            <input type="number" class="form-control" id="total_harga" readonly name="total_harga" required>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="card-footer">
                                      <button type="submit" name="submit" class="btn btn-block btn-primary">Simpan</button>                    
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
