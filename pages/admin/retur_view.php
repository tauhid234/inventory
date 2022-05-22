    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');

        include('../../model/ReturModel.php');
        include('../../model/SalesModel.php');
        include('../../model/CustomerModel.php');
        
        $model = new ReturModel;
        $model_sales = new SalesModel;
        $model_customer = new CustomerModel;
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
  include('../../controller/ReturController.php');
  $alert = "";

  $controller = new ReturController;
  if(isset($_POST['search'])){

    $tgl_mulai = $_POST['tanggal_mulai'];
    $tgl_akhir = $_POST['tanggal_akhir'];
    $id_sales = $_POST['id_sales'];
    $id_customer = $_POST['id_customer'];
    $default = $model->ViewCustom($tgl_mulai, $tgl_akhir, $id_sales, $id_customer);

  }else{
    $default = $model->View();
  }


  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Retur </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Retur</a></li>
              <li class="breadcrumb-item active">Data Retur</li>
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
              <div class="card-header"></div>
              <div class="card-body">
                <form method="POST" action="">
                  <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Tanggal Mulai</label>
                          <input type="date" name="tanggal_mulai" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" class="form-control" required>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Sales <span style="color: red;">*</span></label>
                        <select class="form-control select2" name="id_sales" required>
                          <option value="">-PILIH-</option>
                          <?php foreach($model_sales->View() as $mdl){ ?>
                                  <option value="<?= $mdl['id_sales']; ?>"><?= $mdl['name_sales'];?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Customer <span style="color: red;">*</span></label>
                        <select class="form-control select2" name="id_customer" required>
                          <option value="">-PILIH-</option>
                          <?php foreach($model_customer->View() as $mdl){ ?>
                                  <option value="<?= $mdl['id_customer']; ?>"><?= $mdl['name_customer'];?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <button type="submit" name="search" class="btn btn-block btn-primary" style="margin-top: 30px;">Tampilkan Data</button>
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
            <div class="card card-warning">
                <div class="card-header">
                  
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                      <th style="width: 10px">No Invoice</th>
                      <th>Tanggal Retur</th>
                      <th>Nama Barang</th>
                      <th>Nama Sales</th>
                      <th>Nama Pelanggan</th>
                      <th>Jumlah Retur</th>
                      <th>Total Retur</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach($default as $data){
                    ?>
                    <tr>
                      <td><?= substr($data['name_sales'], 0, 2); ?><?= $data['no_invoice']; ?></td>
                      <td><?= $data['retur_date']; ?></td>
                      <td><?= $data['name_item']; ?></td>
                      <td><?= $data['name_sales']; ?></td>
                      <td><?= $data['name_customer']; ?></td>
                      <td><?= $data['retur_amount']; ?></td>
                      <td><?= $data['total_potongan']; ?></td>
                    </tr>
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