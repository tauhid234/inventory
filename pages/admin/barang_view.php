    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');
        include('../../model/ItemsModel.php');
        $model = new ItemsModel();
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
    $purchase_price = $_POST['harga_penjualan'];
    $selling_price = $_POST['harga_pembelian'];

    $alert = $controller->UpdateController($id, $username, $name_item, $size, $size_type, $quantity, $unit_type, $purchase_price, $selling_price);
  }

  if(isset($_POST['hapus'])){
    $id = $_POST['id'];
    $alert = $controller->DeleteController($id);
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
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-edit-<?= $data['id']; ?>">EDIT</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-hapus-<?= $data['id']; ?>">HAPUS</a>
                        </div>
                      </td>
                    </tr>


                    <!-- MODAL -->
                    <div class="modal fade" id="modal-edit-<?= $data['id'];?>">
                      <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">EDIT DATA</h4>
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
                                                <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Nama Barang <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" name="id" hidden value="<?= $data['id_item']; ?>" required>
                                                    <input type="text" class="form-control" name="nama_barang" value="<?= $data['name_item']; ?>" required>
                                                </div>
                                                </div>
                                                <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Nomor Ukuran<span style="color: red;">*</span></label>
                                                    <input type="number" class="form-control" name="nomor_ukuran" value="<?= $data['size']; ?>" required>
                                                </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Jenis Ukuran<span style="color: red;">*</span></label>
                                                        <select class="form-control" name="jenis_ukuran" required>
                                                            <option value="">-PILIH-</option>
                                                            <option value="CM" <?=$data['size_type'] == 'CM' ? ' selected="selected"' : '';?>>CM</option>
                                                            <option value="M" <?=$data['size_type'] == 'M' ? ' selected="selected"' : '';?>>METER</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Kuantitas <span style="color: red;">*</span></label>
                                                    <input type="number" class="form-control" name="kuantitas" value="<?= $data['quantity']; ?>" required>
                                                </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Jenis Satuan<span style="color: red;">*</span></label>
                                                        <select class="form-control" name="jenis_satuan" required>
                                                            <option value="">-PILIH-</option>
                                                            <option value="PIECES" <?=$data['unit_type'] == 'PIECES' ? ' selected="selected"' : '';?>>PIECES</option>
                                                            <option value="BOX" <?=$data['unit_type'] == 'BOX' ? ' selected="selected"' : '';?>>BOX</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Harga Pembelian<span style="color: red;">*</span></label>
                                                    <input type="number" class="form-control" name="harga_pembelian" value="<?= $data['purchase_price']; ?>" required>
                                                </div>
                                                </div>
                                                <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Harga Penjualan<span style="color: red;">*</span></label>
                                                    <input type="number" class="form-control" name="harga_penjualan" value="<?= $data['selling_price']; ?>" required>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <button type="submit" name="update" class="btn btn-block btn-primary">SIMPAN PERUBAHAN</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                  <!-- /.card-body -->
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->


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