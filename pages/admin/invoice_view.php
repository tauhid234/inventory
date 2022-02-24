    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');

        include('../../model/InvoiceModel.php');
        
        $model = new InvoiceModel();
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
  include('../../controller/InvoiceController.php');
  $alert = "";

  $controller = new InvoiceController();

  if(isset($_POST['update'])){
      
      $username = $_SESSION['username'];
      $id_invoice = $_POST['id_invoice'];
      $status_bayar = $_POST['status_pembayaran'];

      $alert = $controller->UpdateController($id_invoice, $username, $status_bayar);

  }


  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Invoice Penjualan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Invoice</a></li>
              <li class="breadcrumb-item active">Data Invoice Penjualan</li>
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
                <div class="card-header">
                  
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                      <th style="width: 10px">No Invoice</th>
                      <th>Di Buat</th>
                      <th>Nama Sales</th>
                      <th>Nama Pelanggan</th>
                      <th>Tanggal Tempo</th>
                      <th>Status Bayar</th>
                      <th>Keterangan</th>
                      <th>Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach($model->ViewSingleInvoice() as $data){
                    ?>
                    <tr>
                      <td><?= substr($data['name_sales'], 0, 2); ?><?= $data['no_invoice']; ?></td>
                      <td><?= $data['create_date']; ?></td>
                      <td><?= $data['name_sales']; ?></td>
                      <td><?= $data['name_customer']; ?></td>
                      <td><?= $data['tempo_date']; ?></td>
                      <?php if($data['status_pay'] == "UNPAID"){ ?>
                      <td><span class="badge badge-danger">BELUM BAYAR</span></td>
                      <?php } else{ ?>
                      <td><span class="badge badge-primary">SUDAH BAYAR</span></td>
                      <?php } ?>
                      <td>Cicilan</td>
                      <td>
                        <div class="btn-group">
                            <!-- <button type="button" class="btn btn-danger" disabled>Action</button>
                            <button type="button" class="btn btn-danger dropdown-toggle" disabled data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item" href="input_detail_penjualan.php?item=<?= $data['id_item']; ?>">Jual</a>
                          </div> -->
                            <button type="button" class="btn btn-success">Action</button>
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <?php if($data['tempo_date'] == null){ ?>
                              <a class="dropdown-item" href="input_detail_invoice?detail=<?= $data['no_invoice']; ?>&v=<?= $data['sale_versi_invoice']; ?>">Input Jatuh Tempo</a>
                              <?php } else{ ?>
                              <a class="dropdown-item" href="retur?retur=<?= $data['no_invoice']; ?>&v=<?= $data['sale_versi_invoice']; ?>">Retur</a>
                              <?php } if($data['status_pay'] == 'UNPAID' && $data['tempo_date'] != null){?>
                              <a class="dropdown-item" href="update_payment_invoice?detail=<?= $data['no_invoice']; ?>&v=<?= $data['sale_versi_invoice']; ?>">Update Status Bayar</a>
                              <?php }else{}?>
                              <a class="dropdown-item" target="_blank" href="cetak/invoice_v2?inv=<?= $data['sale_versi_invoice']; ?>">Cetak</a>
                          </div>
                        </div>
                      </td>
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