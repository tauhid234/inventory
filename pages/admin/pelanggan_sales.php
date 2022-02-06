    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');

        include('../../model/CustomerModel.php');
        include('../../model/SalesModel.php');
        
        $model_customer = new CustomerModel;
        $model_sales = new SalesModel;
        $username = $_SESSION['username'];
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

  
include('../../controller/MatchSalesCustomerController.php');

$controller = new MatchSalesCustomerController;
  

  $alert = "";

  $hari_ini = date("Y-m-d");
  $tgl_now = gmdate('Y-m-d');
  $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
  $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));



  if(isset($_POST['submit'])){

      $username = $_SESSION['username'];
      $id_customer = $_POST['id_customer'];
      $id_sales = $_POST['id_sales'];

      $alert = $controller->AddController($username,$id_customer,$id_sales);

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
            <h1 class="m-0">Pelanggan Sales</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Sales</li>
              <li class="breadcrumb-item active">Pelanggan Sales</li>
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
              <div class="card-header">Tambahkan Pelanggan Sales</div>
              <div class="card-body">
                <form method="post" action="">
                  <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Sales <span style="color: red;">*</span></label>
                            <select class="form-control select2" name="id_sales" required>
                              <option value="">-PILIH-</option>
                              <?php foreach($model_sales->View() as $mdl){ ?>
                                <option value="<?= $mdl['id_sales']; ?>"><?= $mdl['name_sales'];?></option>
                              <?php } ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Pelanggan <span style="color: red;">*</span></label>
                            <select class="form-control select2" name="id_customer" required>
                              <option value="">-PILIH-</option>
                              <?php foreach($model_customer->View() as $mdl){ ?>
                                <option value="<?= $mdl['id_customer']; ?>"><?= $mdl['name_customer'];?></option>
                              <?php } ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <button type="submit" name="submit" class="btn btn-block btn-primary" style="margin-top: 30px;">Simpan</button>
                        </div>
                      </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div class="card card-success">
              <div class="card-header">Data Pelanggan Sales</div>
              <div class="card-body">
                <table class="table table-bordered table-striped" id="example1">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama Sales</th>
                        <th>Nama Pelanggan</th>
                        <th>Action</th>
                        <!-- <th>Tindakan</th> -->
                      </tr>
                    </thead>
                    <tbody>

                        <?php
                        $no = 1;
                        foreach($controller->ViewController() as $data){?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['name_sales']; ?></td>
                            <td><?= $data['name_customer']; ?></td>
                            <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-success">Action</button>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-edit-<?= $data['id']; ?>">EDIT</a> -->
                                    <a class="dropdown-item" href="edit_pelanggan_sales?id=<?= $data['id_match_sales_customer']; ?>">EDIT</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-hapus-<?= $data['id']; ?>">HAPUS</a>
                                </div>
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
                                <input type="text" hidden name="id" class="form-control" value="<?= $data['id_match_sales_customer'];?>">
                                <p>Apakah anda yakin ingin menghapus Pelanggan Sales <b><?= $data['name_sales']; ?></b> dengan nama pelanggan <b><?= $data['name_customer']; ?></b> ?</p>
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

                        <?php } ?>
                    </tbody>
                  </table>
              </div>
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