    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');
        include('../../model/ProfitModel.php');
        include('../../model/SalesModel.php');
        $model = new ProfitModel;
        $model_sales = new SalesModel;
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
  $earliest_year = 2000;
  $already_selected_value = date('Y');

  // if(isset($_POST['update'])){
    
  //   $jumlah_profit = $_POST['jumlah_profit'];
    
  //   for($i = 0; $i < count($jumlah_profit); $i++){
      
  //     $username = $_SESSION['username'];
  //     $bulan = $_POST['bulan'];
  //     $tahun = $_POST['tahun'];
  //     $jumlah_profits = $_POST['jumlah_profit'][$i];
  //     $id_sales = $_POST['id_sales'][$i];
  //     $alert = $model->SyncronizeProfit($id_sales, $bulan, $tahun, $username);
  //   }
  // }

  
  if(isset($_POST['search'])){
    
      $bulan = $_POST['bulan'];
      $tahun = $_POST['tahun'];
      $id_sales = $_POST['sales'];
      $data_profit = $model->ViewCustom($id_sales, $bulan, $tahun);
  }else{
    $data_profit = [];
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
        <div class="row">
          <div class="col-md-12">
            <div class="card card-warning">
              <div class="card-header"></div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Bulan <span style="color: red;">*</span></label>
                            <select class="form-control select2" name="bulan" required>
                              <option value="">-PILIH-</option>
                              <option value="01">Januari</option>
                              <option value="02">Februari</option>
                              <option value="03">Maret</option>
                              <option value="04">April</option>
                              <option value="05">Mei</option>
                              <option value="06">Juni</option>
                              <option value="07">Juli</option>
                              <option value="08">Agustus</option>
                              <option value="09">September</option>
                              <option value="10">Oktober</option>
                              <option value="11">November</option>
                              <option value="12">Desember</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tahun <span style="color: red;">*</span></label>
                            <select class="form-control select2" name="tahun" required>
                              <option value="">-PILIH-</option>
                              <?php 
                              foreach (range(date('Y'), $earliest_year) as $x) {
                                print '<option value="'.$x.'"'.($x === $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
                            }
                            ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Nama Sales <span style="color: red;">*</span></label>
                          <select class="form-control select2" name="sales" required>
                              <option value="">-PILIH-</option>
                              <?php foreach ($model_sales->View() as $sales) {?>
                                <option value="<?= $sales['id_sales']; ?>"><?= $sales['name_sales'];?></option>
                            <?php } ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <!-- <button type="submit" name="update" class="btn btn-block btn-primary" style="margin-top: 30px;">SYNCRONIZE DATA</button> -->
                          <button type="submit" name="search" class="btn btn-block btn-primary" style="margin-top: 30px;">CARI DATA PROFIT</button>
                        </div>
                      </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-md-3">
            <!-- <button type="submit" name="update" class="btn btn-primary">SYNCRONIZE DATA</button> -->
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
                      <th>No Invoice</th>
                      <th>Bulan</th>
                      <th>Tahun</th>
                      <th>Total Keuntungan</th>
                      <!-- <th>Potongan Sales</th>
                      <th>Tanggal Final</th> -->
                      <!-- <th>Total Pendapatan</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach($data_profit as $data){
                    ?>
                    <tr>
                      <td><?= $no++; ?>
                          <input type="text" name="id_sales[]" class="form-control" hidden value="<?= $data['id_sales'];?>">
                          <input type="text" name="jumlah_profit[]" class="form-control" hidden value="<?= $data['profit'];?>"></td>
                      <td><?= $data['name_sales']; ?></td>
                      <td><?= substr($data['name_sales'], 0, 2);?><?= $data['no_invoice_sale_profit']; ?></td>
                      <td><?php 
                          $explode = explode("-",$data['create_date']);
                          echo $model->konversiMonth($explode[1]); ?></td>
                      <td><?php 
                          $explode = explode("-",$data['create_date']);
                          echo $explode[0]; ?></td>
                      <td><?= $data['profit']; ?></td>
                      <!-- <td><span class="badge badge-danger"><?= $data['potongan_sales']; ?></span></td>
                      <td><?= $data['final_date']; ?></td> -->
                      <!-- <td><?= $data['total_pendapatan_sales']; ?></td> -->
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