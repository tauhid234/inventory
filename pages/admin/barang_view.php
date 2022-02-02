    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');
        include('../../model/ItemsModel.php');
        include('../../model/SizeModel.php');
        include('../../model/UnitModel.php');
        $model_size = new SizeModel;
        $model_unit = new UnitModel;
        $model = new ItemsModel;
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

  $controller = new ItemsController();

  if(isset($_POST['update'])){
    $id = $_POST['id'];
    
    $username = $_SESSION['username'];

    $name_item = $_POST['nama_barang'];
    $size = $_POST['nomor_ukuran'];
    $size_type = $_POST['jenis_ukuran'];
    $quantity = $_POST['kuantitas'];
    $unit_type = $_POST['jenis_satuan'];
    $selling_price = $_POST['harga_penjualan'];
    $purchase_price = $_POST['harga_pembelian'];

    $alert = $controller->UpdateController($id, $username, $name_item, $size, $size_type, $quantity, $unit_type, $purchase_price, $selling_price);
  }

  if(isset($_POST['hapus'])){
    $id = $_POST['id'];
    $alert = $controller->DeleteController($id);
  }

  if(isset($_POST['save_ukuran'])){
    $nama_ukuran = $_POST['nama_ukuran'];

    $alert = $size_controller->AddController($nama_ukuran);
  }

  if(isset($_POST['save_unit'])){
    $nama_unit = $_POST['nama_satuan'];

    $alert = $unit_controller->AddController($nama_unit);
  }
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Barang</a></li>
              <li class="breadcrumb-item active">Data Barang</li>
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
            <div class="card card-primary">
                <div class="card-header">
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama Barang</th>
                      <th>Nomor Ukuran</th>
                      <th>Jenis Ukuran</th>
                      <th>Kuantitas</th>
                      <th>Di Buat</th>
                      <th>Jenis Satuan</th>
                      <th>Harga Pembelian</th>
                      <th>Harga Penjualan</th>
                      <th>Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach($model->View() as $data){
                    ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $data['name_item']; ?></td>
                      <td><?= $data['size']; ?></td>
                      <td><?= $data['size_type']; ?></td>
                      <td><?= $data['quantity']; ?></td>
                      <td><?= $data['create_date']; ?></td>
                      <td><?=  $data['unit_type']; ?></td>
                      <td><?=  $data['purchase_price']; ?></td>
                      <td><?=  $data['selling_price']; ?></td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-success">Action</button>
                          <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu">
                            <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-edit-<?= $data['id']; ?>">EDIT</a> -->
                            <a class="dropdown-item" href="edit_barang?id=<?= $data['id_item']; ?>">EDIT</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-hapus-<?= $data['id']; ?>">HAPUS</a>
                        </div>
                      </td>
                    </tr>


                    <!-- MODAL DELETE -->
                    <div class="modal fade" id="modal-hapus-<?= $data['id']; ?>">
                      <div class="modal-dialog">
                        <form method="post" action="">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Konfirmasi Hapus</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <input type="text" hidden name="id" class="form-control" value="<?= $data['id_item'];?>">
                              <p>Apakah anda yakin ingin menghapus nama barang <b><?= $data['name_item']; ?></b> ?</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                              <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                            </div>
                          </div>
                        </form>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- END MODAL DELETE -->

                    <?php 
                     } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>        
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