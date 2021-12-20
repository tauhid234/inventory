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
  include('../../controller/ItemsController.php');
  $alert = "";

  $input = new ItemsController();

  if(isset($_POST['submit'])){

    $username = $_SESSION['username'];
    $name_item = $_POST['nama_barang'];
    $size = $_POST['nomor_ukuran'];
    $size_type = $_POST['jenis_ukuran'];
    $quantity = $_POST['kuantitas'];
    $unit_type = $_POST['jenis_satuan'];
    $purchase_price = $_POST['harga_penjualan'];
    $selling_price = $_POST['harga_pembelian'];

    $alert = $input->AddController($username, $name_item, $size, $size_type, $quantity, $unit_type, $purchase_price, $selling_price);
    
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
                        <input type="number" class="form-control" name="nomor_ukuran" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Jenis Ukuran<span style="color: red;">*</span></label>
                            <select class="form-control" name="jenis_ukuran" required>
                                <option value="">-PILIH-</option>
                                <option value="CM">CM</option>
                                <option value="M">METER</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Kuantitas <span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="kuantitas" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Jenis Satuan<span style="color: red;">*</span></label>
                            <select class="form-control" name="jenis_satuan" required>
                                <option value="">-PILIH-</option>
                                <option value="PIECES">PIECES</option>
                                <option value="BOX">BOX</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- FOOTER -->
    <?php
    include('../../component_temp/footer.php');
    ?>
  <!-- END FOOTER -->
