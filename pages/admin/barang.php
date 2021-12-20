    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');
        include('../../model/CategoryModel.php');
        $model = new CategoryModel();
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
  include('../../controller/CategoryController.php');
  $alert = "";

  $input = new CategoryController();

  if(isset($_POST['submit'])){

    $name_category = $_POST['nama_kategori'];

    $alert = $input->AddController($name_category);
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
                        <label>Jenis Kategori<span style="color: red;">*</span></label>
                        <select class="form-control" name="kategori" required>
                            <option value="">-PILIH-</option>
                            <?php 
                             foreach($model->View() as $data){
                             ?>
                            <option value="<?= $data['name_category']; ?>"><?= $data['name_category'];?></option>
                            <?php } ?>
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
                            <select class="form-control" name="kategori" required>
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
                        <input type="text" class="form-control" name="harga_pembelian" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Harga Penjualan<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="harga_penjualan" required>
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
