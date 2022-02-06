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



  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $data_edit = $controller->ViewIdController($id);
  }

  if(isset($_POST['submit'])){

      $username = $_SESSION['username'];
      $id = $_POST['id'];
      $id_customer = $_POST['id_customer'];
      $id_sales = $_POST['id_sales'];

      $alert = $controller->UpdateController($id,$username,$id_customer,$id_sales);

  }

  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Pelanggan Sales</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Sales</li>
              <li class="breadcrumb-item active">Edit Pelanggan Sales</li>
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
              <div class="card-header">Edit Pelanggan Sales</div>
              <div class="card-body">
                <form method="post" action="">
                  <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Sales <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="id" hidden value="<?= $data_edit[0]['id_match_sales_customer']; ?>">
                            <select class="form-control select2" name="id_sales" required>
                              <option value="">-PILIH-</option>
                              <?php foreach($model_sales->View() as $mdl){ 
                                if($data_edit[0]['id_sales'] == $mdl['id_sales']){?>
                                <option value="<?= $mdl['id_sales']; ?>" <?php echo "selected"; ?>><?= $mdl['name_sales'];?></option>
                                <?php }else{?>
                                <option value="<?= $mdl['id_sales']; ?>"><?= $mdl['name_sales'];?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Pelanggan <span style="color: red;">*</span></label>
                            <select class="form-control select2" name="id_customer" required>
                              <option value="">-PILIH-</option>
                              <?php foreach($model_customer->View() as $mdl){ 
                                if($data_edit[0]['id_customer'] == $mdl['id_customer']){?>
                                <option value="<?= $mdl['id_customer']; ?>" <?php echo "selected"; ?>><?= $mdl['name_customer'];?></option>
                                <?php }else{?>
                                <option value="<?= $mdl['id_customer']; ?>"><?= $mdl['name_customer'];?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <button type="submit" name="submit" class="btn btn-block btn-primary" style="margin-top: 30px;">Simpan Perubahan</button>
                        </div>
                      </div>
                    </div>
                </form>
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