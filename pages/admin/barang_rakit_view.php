    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');
        include('../../model/RaftsModel.php');
        $model = new RaftsModel;
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
  include('../../controller/RaftsController.php');
  $alert = "";

  $controller = new RaftsController;

  if(isset($_POST['update'])){
    $id = $_POST['id'];
    
    $username = $_SESSION['username'];

    $name_item = $_POST['nama_barang'];
    $quantity = $_POST['kuantitas'];
    $status = $_POST['status_perbaikan'];

    $alert = $controller->UpdateController($id, $name_item, $username, $quantity, $status);
  }
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Barang Rakit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Barang Rakit</a></li>
              <li class="breadcrumb-item active">Data Barang Rakit</li>
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
                      <th>Status Barang</th>
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
                      <td><?= $data['name_rafts']; ?></td>
                      <td><?= $data['size_rafts']; ?></td>
                      <td><?= $data['size_type_rafts']; ?></td>
                      <td><?= $data['quantity_rafts']; ?></td>
                      <td><?= $data['create_date']; ?></td>
                      <td><?=  $data['unit_type_rafts']; ?></td>
                      <?php if($data['status_rafts'] == "NOT_REPAIR"){?>
                      <td><span class="badge badge-danger">BELUM DIPERBAIKI</span></td>
                      <?php }else if($data['status_rafts'] == "REPAIR"){?>
                      <td><span class="badge badge-warning">DALAM PERBAIKAN</span></td>
                      <?php }else if($data['status_rafts'] == "DONE_REPAIR"){?>
                      <td><span class="badge badge-success">SUDAH DI PERBAIKI</span></td>
                      <?php } ?>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-success">Action</button>
                          <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu">
                            <?php if($data['status_rafts'] == "DONE_REPAIR"){}else{?>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-edit-<?= $data['id']; ?>">UPDATE STATUS BARANG</a>
                            <?php } ?>
                            <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-hapus-<?= $data['id']; ?>">HAPUS</a> -->
                        </div>
                      </td>
                    </tr>


                    <!-- MODAL -->
                    <div class="modal fade" id="modal-edit-<?= $data['id'];?>">
                      <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">UPDATE STATUS BARANG</h4>
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
                                                    <div class="form-group">
                                                        <label>Status Perbaikan Barang</label>
                                                        <select class="form-control" name="status_perbaikan" required>
                                                            <option value="">-PILIH-</option>
                                                            <option value="REPAIR" <?=$data['status_rafts'] == 'REPAIR' ? ' selected="selected"' : '';?>>MEMPERBAIKI</option>
                                                            <option value="DONE_REPAIR" <?=$data['status_rafts'] == 'DONE_REPAIR' ? ' selected="selected"' : '';?>>SELESAI PERBAIKI</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Nama Barang </label>
                                                    <input type="text" class="form-control" name="id" hidden value="<?= $data['id_rafts']; ?>" required>
                                                    <input type="text" class="form-control" name="nama_barang" value="<?= $data['name_rafts']; ?>" readonly>
                                                </div>
                                                </div>
                                                <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Nomor Ukuran</label>
                                                    <input type="number" class="form-control" name="nomor_ukuran" value="<?= $data['size_rafts']; ?>" readonly>
                                                </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Jenis Ukuran</label>
                                                        <select class="form-control" name="jenis_ukuran" disabled>
                                                            <option value="">-PILIH-</option>
                                                            <option value="CM" <?=$data['size_type_rafts'] == 'CM' ? ' selected="selected"' : '';?>>CM</option>
                                                            <option value="M" <?=$data['size_type_rafts'] == 'M' ? ' selected="selected"' : '';?>>METER</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Jumlah Barang Rusak </label>
                                                    <input type="number" class="form-control" name="kuantitas" value="<?= $data['quantity_rafts']; ?>" readonly>
                                                </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Jenis Satuan</label>
                                                        <select class="form-control" name="jenis_satuan" disabled>
                                                            <option value="">-PILIH-</option>
                                                            <option value="PIECES" <?=$data['unit_type_rafts'] == 'PIECES' ? ' selected="selected"' : '';?>>PIECES</option>
                                                            <option value="BOX" <?=$data['unit_type_rafts'] == 'BOX' ? ' selected="selected"' : '';?>>BOX</option>
                                                        </select>
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