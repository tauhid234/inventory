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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan Pembelian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Laporan</a></li>
              <li class="breadcrumb-item active">Laporan Pembelian</li>
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
          <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="laporan_pembelian">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>No Invoice</th>
                      <th>Tanggal Pembelian</th>
                      <th>Nama Barang</th>
                      <th>Nama Suplier</th>
                      <th>Jumlah Beli</th>
                      <th>Harga Pembelian</th>
                      <th>Total Harga Pembelian</th>
                      <th>Status Pembayaran</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach($model->View() as $data){
                    ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $data['no_invoice_purchase']; ?></td>
                      <td><?= $data['purchase_date']; ?></td>
                      <td><?= $data['name_items_purchase']; ?></td>
                      <td><?= $data['name_suplier']; ?></td>
                      <td><?= $data['purchase_amount']; ?></td>
                      <td><?= $data['purchase_price']; ?></td>
                      <td><?= $data['total_amount']; ?></td>
                      <?php if($data['status_pay'] == "UNPAID"){ ?>
                      <td><span class="badge badge-danger">BELUM BAYAR</span></td>
                      <?php } else{ ?>
                      <td><span class="badge badge-primary">SUDAH BAYAR</span></td>
                      <?php } ?>
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