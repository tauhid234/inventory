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
  
  
  if(isset($_GET['id'])){
      $id = $_GET['id'];
      $data_edit = $input->ViewIdController($id);
  }


  if(isset($_POST['submit'])){

    $username = $_SESSION['username'];
    $id = $_POST['id'];
    $name_item = $_POST['nama_barang'];
    $size = $_POST['nomor_ukuran'];
    $size_type = $_POST['jenis_ukuran'];
    $quantity = $_POST['kuantitas'];
    $unit_type = $_POST['jenis_satuan'];
    $purchase_price = $_POST['harga_pembelian'];
    $selling_price = $_POST['harga_penjualan'];

    $data_edit = $input->ViewIdController($id);
    $alert = $input->UpdateController($id, $username, $name_item, $size, $size_type, $quantity, $unit_type, $purchase_price, $selling_price);
    
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
          <h1 class="m-0">Edit Barang</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Barang</a></li>
            <li class="breadcrumb-item active">Edit Barang</li>
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
                        <input type="text" class="form-control" name="id" hidden value="<?= $data_edit[0]['id_item']; ?>" required>
                        <input type="text" class="form-control" name="nama_barang" value="<?= $data_edit[0]['name_item']?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nomor Ukuran<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="nomor_ukuran" value="<?= $data_edit[0]['size'];?>" required>
                      </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Jenis Ukuran<span style="color: red;">*</span></label>
                            <select class="form-control" name="jenis_ukuran" required>
                                <option value="">-PILIH-</option>
                                <?php foreach($model_size->View() as $data){?>
                                    <?php if($data_edit[0]['size_type'] == $data['jenis_ukuran']){?>
                                    <option value="<?= $data['jenis_ukuran']; ?>" <?php echo "selected"; ?>><?= $data['jenis_ukuran']; ?></option>
                                    <?php }else{ ?>
                                    <option value="<?= $data['jenis_ukuran']; ?>"><?= $data['jenis_ukuran']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Kuantitas <span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="kuantitas" value="<?= $data_edit[0]['quantity']; ?>" required>
                      </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Jenis Satuan<span style="color: red;">*</span></label>
                            <select class="form-control" name="jenis_satuan" required>
                                <option value="">-PILIH-</option>
                                <?php foreach($model_unit->View() as $data){?>
                                    <?php if($data_edit[0]['unit_type'] == $data['unit_type']){ ?>
                                    <option value="<?= $data['unit_type']; ?>" <?php echo "selected"; ?>><?= $data['unit_type']; ?></option>
                                    <?php }else{ ?>
                                    <option value="<?= $data['unit_type']; ?>"><?= $data['unit_type']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Harga Pembelian<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="harga_pembelian" value="<?= $data_edit[0]['purchase_price']; ?>" required>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Harga Penjualan<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="harga_penjualan" value="<?= $data_edit[0]['selling_price']; ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" name="submit" class="btn btn-block btn-primary">SIMPAN PERUBAHAN</button>
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- FOOTER -->
    <?php
    include('../../component_temp/footer.php');
    ?>
  <!-- END FOOTER -->
