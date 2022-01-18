    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');
        include('../../model/ProfitModel.php');
        $model = new ProfitModel;
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
  $alert = "";


  if(isset($_POST['update'])){
    
    $jumlah_profit = $_POST['jumlah_profit'];
    
    for($i = 0; $i < count($jumlah_profit); $i++){
      
      $username = $_SESSION['username'];
      $jumlah_profits = $_POST['jumlah_profit'][$i];
      $id_sales = $_POST['id_sales'][$i];
      $alert = $model->SyncronizeProfit($id_sales, $jumlah_profits, $username);
    }
  }
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Profit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sales</a></li>
              <li class="breadcrumb-item active">Data Profit</li>
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
        <div class="row mb-4">
          <div class="col-md-3">
            <button type="submit" name="update" class="btn btn-primary">SYNCRONIZE DATA</button>
          </div>
        </div>  
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
                      <th>Nama Sales</th>
                      <th>Bulan</th>
                      <th>Tahun</th>
                      <th>Profit</th>
                      <th>Potongan Sales</th>
                      <th>Tanggal Final</th>
                      <th>Total Pendapatan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach($model->View() as $data){
                    ?>
                    <tr>
                      <td><?= $no++; ?>
                          <input type="text" name="id_sales[]" class="form-control" hidden value="<?= $data['id_sales'];?>">
                          <input type="text" name="jumlah_profit[]" class="form-control" hidden value="<?= $data['profit'];?>"></td>
                      <td><?= $data['name_sales']; ?></td>
                      <td><?php 
                          $explode = explode("-",$data['create_date']);
                          echo $model->konversiMonth($explode[1]); ?></td>
                      <td><?php 
                          $explode = explode("-",$data['create_date']);
                          echo $explode[0]; ?></td>
                      <td><?= $data['profit']; ?></td>
                      <td><span class="badge badge-danger"><?= $data['potongan_sales']; ?></span></td>
                      <td><?= $data['final_date']; ?></td>
                      <td><?= $data['total_pendapatan_sales']; ?></td>
                    </tr>
                    <?php 
                     } ?>
                  </tbody>
                </table>
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