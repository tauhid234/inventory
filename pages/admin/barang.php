    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');
        include('../../model/SizeModel.php');
        include('../../model/UnitModel.php');
        $model_size = new SizeModel;
        $model_unit = new UnitModel;
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
  include('../../controller/ItemsController.php');
  include('../../controller/SizeController.php');
  include('../../controller/UnitController.php');

  $alert = "";

  $input = new ItemsController();
  $size_controller = new SizeController;
  $unit_controller = new UnitController;

  if(isset($_POST['submit'])){

    $username = $_SESSION['username'];
    $name_item = $_POST['nama_barang'];
    $size = $_POST['nomor_ukuran'];
    $size_type = $_POST['jenis_ukuran'];
    $quantity = $_POST['kuantitas'];
    $unit_type = $_POST['jenis_satuan'];
    $purchase_price = $_POST['harga_pembelian'];
    $selling_price = $_POST['harga_penjualan'];

    $alert = $input->AddController($username, $name_item, $size, $size_type, $quantity, $unit_type, $purchase_price, $selling_price);
    
  }

  if(isset($_POST['save_ukuran'])){
    $nama_ukuran = $_POST['nama_ukuran'];

    $alert = $size_controller->AddController($nama_ukuran);
  }

  if(isset($_POST['save_unit'])){
    $nama_unit = $_POST['nama_satuan'];

    $alert = $unit_controller->AddController($nama_unit);
  }

  // $input->inputUser();
  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Barang</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Barang</a></li>
            <li class="breadcrumb-item active">Tambah Barang</li>
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
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post" action="">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nama Barang <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="nama_barang" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nomor Ukuran<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="nomor_ukuran" required>
                      </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Jenis Ukuran<span style="color: red;">*</span></label>
                            <select class="form-control" name="jenis_ukuran" required>
                                <option value="">-PILIH-</option>
                                <?php foreach($model_size->View() as $data){?>
                                <option value="<?= $data['jenis_ukuran']; ?>"><?= $data['jenis_ukuran']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                      <div class="form-group">
                        <button type="button" class="btn btn-block btn-primary form-control" style="margin-top: 30px;" data-toggle="modal" data-target="#modal-size">+</button>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Kuantitas <span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="kuantitas" required>
                      </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Jenis Satuan<span style="color: red;">*</span></label>
                            <select class="form-control" name="jenis_satuan" required>
                                <option value="">-PILIH-</option>
                                <?php foreach($model_unit->View() as $data){?>
                                <option value="<?= $data['unit_type']; ?>"><?= $data['unit_type']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                      <div class="form-group">
                        <button type="button" class="btn btn-block btn-primary form-control" style="margin-top: 30px;" data-toggle="modal" data-target="#modal-unit">+</button>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Harga Pembelian<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="harga_pembelian" required>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Harga Penjualan<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="harga_penjualan" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" name="submit" class="btn btn-block btn-primary">SIMPAN</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->

       <!-- MODAL ADD SIZE -->
       <div class="modal fade" id="modal-size">
        <div class="modal-dialog">
          <form method="post" action="">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">TAMBAH JENIS UKURAN</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                  <div class="card card-warning">
                      <div class="card-header">
                      </div>
                      <!-- /.card-header -->
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-sm-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>NAMA UKURAN<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="nama_ukuran" required>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="save_ukuran" class="btn btn-block btn-primary">SIMPAN</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              </div>
            </div>
          </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- END MODAL ADD SIZE -->
       
      <!-- MODAL ADD UNIT -->
       <div class="modal fade" id="modal-unit">
        <div class="modal-dialog">
          <form method="post" action="">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">TAMBAH JENIS SATUAN</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                  <div class="card card-warning">
                      <div class="card-header">
                      </div>
                      <!-- /.card-header -->
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-sm-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>NAMA SATUAN<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="nama_satuan" required>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="save_unit" class="btn btn-block btn-primary">SIMPAN</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              </div>
            </div>
          </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- END MODAL ADD SIZE -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- FOOTER -->
    <?php
    include('../../component_temp/footer.php');
    ?>
  <!-- END FOOTER -->
