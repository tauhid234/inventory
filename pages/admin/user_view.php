    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');
        include('../../model/UserModel.php');
        $usermodel = new UserModel();
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

  $controller = new UserController();

  if(isset($_POST['update'])){
    $id = $_POST['id'];
    $username = $_POST['nama_pengguna'];
    $nohp = $_POST['nomor_handphone'];
    $email = $_POST['email'];
    $peran = $_POST['peran'];
    $status = $_POST['status'];

    $alert = $controller->updateUser($id, $username, $nohp, $email, $peran, $status);
  }

  if(isset($_POST['hapus'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $alert = $controller->Delete($id,$username);
  }
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Daftar Pengguna</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
              <li class="breadcrumb-item active">Daftar Pengguna</li>
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
                      <th>Nama Pengguna</th>
                      <th>Nomor Hanphone</th>
                      <th>Email</th>
                      <th>Peran</th>
                      <th>Dibuat Pada</th>
                      <th>Status</th>
                      <th>Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach($usermodel->tampil_data() as $data){
                    ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $data['username']; ?></td>
                      <td><?= $data['no_handphone']; ?></td>
                      <td><?= $data['email']; ?></td>
                      <td><?= $data['peran']; ?></td>
                      <td><?=  $data['create_date']; ?></td>
                      <?php if($data['status'] == "AKTIF"){?>
                      <td><span class="badge bg-primary"><?= $data['status']; ?></span></td>
                      <?php }else{ ?>
                      <td><span class="badge bg-danger"><?= $data['status']; ?></span></td>
                      <?php } ?>
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
                                            <label>Nama Pengguna <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="nama_pengguna" readonly value="<?= $data['username']; ?>" required>
                                            <input hidden type="text" class="form-control" name="id" value="<?= $data['id']; ?>">
                                          </div>
                                          <div class="form-group">
                                            <label>Nomor Handphone <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="nomor_handphone" data-inputmask='"mask": "(999) 999-999-999"' data-mask value="<?= $data['no_handphone']; ?>" required>
                                          </div>
                                          <div class="form-group">
                                            <label>Email Pengguna <span style="color: red;">*</span></label>
                                            <input type="email" class="form-control" name="email" value="<?= $data['email']; ?>" required>
                                          </div>
                                          <div class="form-group">
                                            <label>Peran <span style="color: red;">*</span></label>
                                            <select class="form-control" name="peran" required>
                                              <option value="">-PILIH-</option>
                                              <option value="ADMIN" <?=$data['peran'] == 'ADMIN' ? ' selected="selected"' : '';?>>Admin</option>
                                              <option value="SALES"<?=$data['peran'] == 'SALES' ? ' selected="selected"' : '';?>>Sales</option>
                                            </select>
                                          </div>
                                          <div class="form-group">
                                            <label>Status Pengguna <span style="color: red;">*</span></label>
                                            <select class="form-control" name="status" required>
                                              <option value="">-PILIH-</option>
                                              <option value="AKTIF" <?=$data['status'] == 'AKTIF' ? ' selected="selected"' : '';?>>AKTIF</option>
                                              <option value="NON AKTIF" <?=$data['status'] == 'NON AKTIF' ? ' selected="selected"' : '';?>>NON AKTIF</option>
                                            </select>
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
                              <input type="text" hidden name="id" class="form-control" value="<?= $data['id'];?>">
                              <input type="text" hidden name="username" class="form-control" value="<?= $data['username'];?>">
                              <p>Apakah anda yakin ingin mengahpus user <b><?= $data['username']; ?></b> ?</p>
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