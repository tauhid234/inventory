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
  include('../../controller/CustomerController.php');
  $alert = "";

  $controller = new CustomerController();

  if(isset($_POST['submit'])){

    $username = $_SESSION['username'];

    $name_customer = $_POST['nama_customer'];
    $nohp = $_POST['nomor_handphone'];
    $email = $_POST['email'];
    $kota = $_POST['kota'];
    $kode_pos = $_POST['kode_pos'];
    $alamat = $_POST['alamat'];

    $alert = $controller->AddController($username, $name_customer, $nohp, $email, $kota, $kode_pos, $alamat);
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
          <h1 class="m-0">Tambah Pelanggan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
            <li class="breadcrumb-item active">Tambah Pelanggan</li>
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
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nama Pelanggan <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="nama_customer" required>
                      </div>
                      <div class="form-group">
                        <label>Nomor Handphone <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="nomor_handphone" data-inputmask='"mask": "(999) 999-999-999"' data-mask required>
                      </div>
                      <div class="form-group">
                        <label>Email <span style="color: red;">*</span></label>
                        <input type="email" class="form-control" name="email" required>
                      </div>
                      <div class="form-group">
                        <label>Kota <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="kota" required>
                      </div>
                      <div class="form-group">
                        <label>Kode POS <span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="kode_pos" required>
                      </div>
                      <div class="form-group">
                        <label>Alamat <span style="color: red;">*</span></label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="alamat"></textarea>
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
