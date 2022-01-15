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
  include('../../controller/UserController.php');
  $alert = "";

  $input = new UserController();

  if(isset($_POST['submit'])){

    $username = $_POST['nama_pengguna'];
    $nohp = $_POST['nomor_handphone'];
    $email = $_POST['email'];
    $peran = $_POST['peran'];
    $password = $_POST['kata_sandi'];
    $konfirm_pass = $_POST['konfirm_kata_sandi'];

    $alert = $input->inputUser($username, $nohp, $email, $peran, $password, $konfirm_pass);
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
          <h1 class="m-0">Tambah Pengguna</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Penguna</a></li>
            <li class="breadcrumb-item active">Tambah Pengguna</li>
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
                        <label>Nama Pengguna <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="nama_pengguna" required>
                      </div>
                      <div class="form-group">
                        <label>Nomor Handphone <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="nomor_handphone" data-inputmask='"mask": "(999) 999-999-999"' data-mask required>
                      </div>
                      <div class="form-group">
                        <label>Email Pengguna <span style="color: red;">*</span></label>
                        <input type="email" class="form-control" name="email" required>
                      </div>
                      <div class="form-group">
                        <label>Peran <span style="color: red;">*</span></label>
                        <select class="form-control" name="peran" required>
                          <option value="">-PILIH-</option>
                          <option value="ADMIN">Admin</option>
                          <option value="ADMIN_HRD">Admin HRD</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Kata Sandi <span style="color: red;">*</span></label>
                        <input type="password" class="form-control" name="kata_sandi" required>
                      </div>
                      <div class="form-group">
                        <label>Konfirmasi Kata Sandi <span style="color: red;">*</span></label>
                        <input type="password" class="form-control" name="konfirm_kata_sandi" required>
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
