    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');

        include('../../model/SuplierModel.php');
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
  include('../../controller/PurchaseController.php');

  $alert = "";

  $controller = new PurchaseController;

  $hari_ini = date("Y-m-d");


  if(isset($_POST['submit'])){
    $id_suplier = $_POST['id_suplier'];
    $no_invoice = $_POST['no_invoice'];
    $tgl_beli = $_POST['tanggal_pembelian'];
    $status_bayar = $_POST['status_bayar'];
    
    $nama_barang = $_POST['nama_barang'];
    $ukuran = $_POST['ukuran'];
    $jenis_ukuran = $_POST['jenis_ukuran'];
    $jenis_satuan = $_POST['jenis_satuan'];
    $harga_beli = $_POST['harga_pembelian'];
    $jumlah_beli = $_POST['jumlah_beli'];
    $total_harga = $_POST['total_harga'];

    $username = $_SESSION['username'];

    

    $alert = $controller->AddController($id_suplier, $no_invoice, $tgl_beli, $status_bayar, $nama_barang, $ukuran, $jenis_ukuran, $jenis_satuan, $harga_beli, $jumlah_beli, $total_harga, $username);
  }

  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pembelian Baru</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Pembelian</a></li>
            <li class="breadcrumb-item"><a href="#">Pembelian Baru</a></li>
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
                                                        <label>Nama Suplier <span style="color: red;">*</span></label>
                                                        <select class="form-control select2" name="id_suplier" required>
                                                          <option value="">-PILIH-</option>
                                                          <?php foreach($model_suplier->View() as $mdl){ ?>
                                                            <option value="<?= $mdl['id_suplier']; ?>"><?= $mdl['name_suplier'];?></option>
                                                          <?php } ?>
                                                        </select>
                                                    </div>
                                                  </div>
                                                  <div class="col-sm-6">
                                                    <div class="form-group">
                                                      <label>Tanggal Pembelian <span style="color: red;">*</span></label>
                                                      <input type="date" required class="form-control" name="tanggal_pembelian">
                                                    </div>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-sm-6">
                                                      <div class="form-group">
                                                          <label>No Invoice <span style="color: red;">*</span> </label>
                                                          <input type="text" required class="form-control" name="no_invoice">
                                                      </div>
                                                  </div>
                                                  <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Status Bayar <span style="color: red;">*</span></label>
                                                        <select class="form-control" name="status_bayar" required>
                                                          <option value="">-PILIH-</option>
                                                            <option value="PAID">BAYAR</option>
                                                            <option value="UNPAID">BELUM BAYAR</option>
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
                                            <label>Nama Barang <span style="color: red;">*</span></label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="text" class="form-control" required name="nama_barang">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Ukuran <span style="color: red;">*</span></label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="number" class="form-control" required name="ukuran">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Jenis Ukuran <span style="color: red;">*</span></label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="text" class="form-control" required name="jenis_ukuran">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Jenis Satuan <span style="color: red;">*</span></label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="text" class="form-control" required name="jenis_satuan">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Harga Pembelian <span style="color: red;">*</span></label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="number" class="form-control" required name="harga_pembelian">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Jumlah Beli <span style="color: red;">*</span></label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="number" class="form-control" name="jumlah_beli" required>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <hr>
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Total Harga <span style="color: red;">*</span></label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="number" class="form-control" required name="total_harga">
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
