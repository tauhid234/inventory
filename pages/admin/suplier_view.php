    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');
        include('../../model/SuplierModel.php');
        $model = new SuplierModel;
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
  include('../../controller/SuplierController.php');
  $alert = "";

  $controller = new SuplierController;

  if(isset($_POST['update'])){
    $id = $_POST['id'];

    $username = $_SESSION['username'];
    
    $name_suplier = $_POST['nama_suplier'];

    
    $nohp = $_POST['nomor_handphone'];
    $email = $_POST['email'];
    $kota = $_POST['kota'];
    $kode_pos = $_POST['kode_pos'];

    $alamat = $_POST['alamat'];

    $alert = $controller->UpdateController($id, $username, $name_suplier, $nohp, $email, $kota, $kode_pos, $alamat);
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
            <h1 class="m-0">Data Suplier</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Suplier</a></li>
              <li class="breadcrumb-item active">Data Suplier</li>
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
                      <th>Nama Suplier</th>
                      <th>Nomor Hanphone</th>
                      <th>Email</th>
                      <th>Kota</th>
                      <th>Dibuat Pada</th>
                      <th>Kode POS</th>
                      <th>Alamat</th>
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
                      <td><?= $data['name_suplier']; ?></td>
                      <td><?= $data['no_handphone_suplier']; ?></td>
                      <td><?= $data['email_suplier']; ?></td>
                      <td><?= $data['kota_suplier']; ?></td>
                      <td><?=  $data['create_date']; ?></td>
                      <td><?= $data['kode_pos_suplier']; ?></td>
                      <td><?= $data['alamat_suplier']; ?></td>
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
                                        <div class="col-sm-12">
                                          <!-- text input -->
                                          <div class="form-group">
                                            <label>Nama Suplier <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="nama_suplier" value="<?= $data['name_suplier']; ?>" required>
                                            <input hidden type="text" class="form-control" name="id" value="<?= $data['id_suplier']; ?>">
                                          </div>
                                          <div class="form-group">
                                            <label>Nomor Handphone <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="nomor_handphone" data-inputmask='"mask": "(999) 999-999-999"' data-mask value="<?= $data['no_handphone_suplier']; ?>" required>
                                          </div>
                                          <div class="form-group">
                                            <label>Email Suplier <span style="color: red;">*</span></label>
                                            <input type="email" class="form-control" name="email" value="<?= $data['email_suplier']; ?>" required>
                                          </div>
                                          <div class="form-group">
                                            <label>Kota <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="kota" value="<?= $data['kota_suplier']; ?>" required>
                                          </div>
                                          <div class="form-group">
                                            <label>Kode POS <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="kode_pos" value="<?= $data['kode_pos_suplier']; ?>" required>
                                          </div>
                                          <div class="form-group">
                                            <label>Alamat <span style="color: red;">*</span></label>
                                            <textarea class="form-control" rows="3" placeholder="Enter ..." name="alamat"><?= $data['alamat_suplier']; ?></textarea>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="justify-content-between">
                                        <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
                              <input type="text" hidden name="id" class="form-control" value="<?= $data['id_suplier'];?>">
                              <p>Apakah anda yakin ingin menghapus suplier <b><?= $data['name_suplier']; ?></b> ?</p>
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