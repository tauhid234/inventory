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
                <form method="POST">
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nama Pengguna <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="nama_pengguna">
                      </div>
                      <div class="form-group">
                        <label>Nomor Handphone <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="nomor_handphone" data-inputmask='"mask": "(999) 999-999-999-9"' data-mask>
                      </div>
                      <div class="form-group">
                        <label>Email Pengguna <span style="color: red;">*</span></label>
                        <input type="email" class="form-control" name="email">
                      </div>
                      <div class="form-group">
                        <label>Peran <span style="color: red;">*</span></label>
                        <select class="form-control" name="peran">
                          <option value="">-PILIH-</option>
                          <option value="admin">Admin</option>
                          <option value="sales">Sales</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Kata Sandi <span style="color: red;">*</span></label>
                        <input type="password" class="form-control" name="kata_sandi">
                      </div>
                      <div class="form-group">
                        <label>Konfirmasi Kata Sandi <span style="color: red;">*</span></label>
                        <input type="password" class="form-control" name="konfirm_kata_sandi">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" name="submit" class="btn btn-block btn-primary">SIMPAN</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-block btn-secondary">RESET</button>
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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/dashboard.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<script>
$(function() {
    $('[data-mask]').inputmask();
})
</script>
</body>
</html>
