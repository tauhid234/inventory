    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');

        include('../../model/InvoicePembelianModel.php');
        
        $model = new InvoicePembelianModel;
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
  include('../../controller/InvoicePurchaseController.php');
  $alert = "";

  $controller = new InvoicePurchaseController;


  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Invoice Pembelian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Invoice</a></li>
              <li class="breadcrumb-item active">Data Invoice Pembelian</li>
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
                      <th>Nama Suplier</th>
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
                      <td><?= $data['no_invoice_purchase']; ?></td>
                      <td><?= $data['create_date']; ?></td>
                      <td><?= $data['name_suplier']; ?></td>
                      <?php if($data['status_pay'] == "UNPAID"){ ?>
                      <td><span class="badge badge-danger">BELUM BAYAR</span></td>
                      <?php } else{ ?>
                      <td><span class="badge badge-primary">SUDAH BAYAR</span></td>
                      <?php } ?>
                      <td><?= $data['keterangan_purchase']; ?></td>
                      <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-success">Action</button>
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="update_payment_invoice_pembelian?detail=<?= $data['no_invoice_purchase']; ?>&v=<?= $data['purchase_versi_invoice']; ?>">Update Status Bayar</a>
                                <a class="dropdown-item" href="update_keterangan_invoice_purchase?detail=<?= $data['no_invoice_purchase']; ?>&v=<?= $data['purchase_versi_invoice']; ?>">Update Keterangan</a>
                                <a class="dropdown-item" target="_blank" href="cetak/invoice_purchase?no_inv=<?= $data['no_invoice_purchase']; ?>&inv=<?= $data['purchase_versi_invoice']; ?>">Cetak</a>
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