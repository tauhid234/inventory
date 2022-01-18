    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');
        include('../../model/PurchaseModel.php');
        $model = new PurchaseModel;
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



  if(isset($_POST['filter'])){
      $tgl_mulai = $_POST['tanggal_mulai'];
      $tgl_akhir = $_POST['tanggal_akhir'];

      if($tgl_mulai == "" || $tgl_akhir == ""){
          return $total_transaksi;
      }

      $view = $model->ViewRangeDate($tgl_mulai, $tgl_akhir);
      $total_transaksi = $model->ViewTransaksiRange($tgl_mulai, $tgl_akhir);
  }else{
    $total_transaksi = $model->ViewTransaksiAll();
    $view = $model->View();
  }

  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Total Pembelian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
              <li class="breadcrumb-item active">Data Total Pembelian</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-regular fa-money-bill-1-wave"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pembelian</span>
                    <span class="info-box-number">Rp <?= number_format($total_transaksi); ?></span>
                </div>
            </div>
        </div>
        <div class="row">
        <form method="post" action="">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        Filter Berdasarkan jangkauan tanggal dibawah ini
                    </div>
                    <div class="card-body">
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
                    </div>
                    <div class="card-footer">
                    <button type="submit" name="filter" class="btn btn-block btn-primary">Tampilkan Data</button>  
                    <a href="total_penjualan.php" class="btn btn-block btn-secondary">Reset</a>
                    </div>
                </div>
            </div>
        </form>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header">
                    Data Pembelian
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Tanggal Pembelian</th>
                      <th>Nama Barang</th>
                      <th>Nama Suplier</th>
                      <th>Jumlah Beli</th>
                      <th>Harga Pembelian</th>
                      <th>Total Pembelian</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach($view as $data){
                    ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $data['purchase_date']; ?></td>
                      <td><?= $data['name_items_purchase']; ?></td>
                      <td><?= $data['name_suplier']; ?></td>
                      <td><?= $data['purchase_amount']; ?></td>
                      <td><?= $data['purchase_price']; ?></td>
                      <td><?= $data['total_amount']; ?></td>
                    </tr>
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