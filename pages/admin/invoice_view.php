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
            <h1 class="m-0">Data Invoice </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Penjualan</a></li>
              <li class="breadcrumb-item active">Penjualan Baru</li>
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
                  Data Barang
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                      <th style="width: 10px">No Invoice</th>
                      <th>Nama Barang</th>
                      <th>Nama Sales</th>
                      <th>Nama Pelanggan</th>
                      <th>Tanggal Tempo</th>
                      <th>Status Bayar</th>
                      <th>Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach($model->View() as $data){
                    ?>
                    <tr>
                      <td><?= $data['no_invoice']; ?></td>
                      <td><?= $data['name_item']; ?></td>
                      <td><?= $data['name_sales']; ?></td>
                      <td><?= $data['name_customer']; ?></td>
                      <td><?= $data['tempo_date']; ?></td>
                      <?php if($data['status_pay'] == "UNPAID"){ ?>
                      <td><span class="badge badge-danger">BELUM BAYAR</span></td>
                      <?php } else{ ?>
                      <td><span class="badge badge-primary">SUDAH BAYAR</span></td>
                      <?php } ?>
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
                              <a class="dropdown-item" href="?modal=<?= $data['id_invoice']; ?>" data-toggle="modal" data-target="#modal-view-<?= $data['id_invoice']; ?>">Lihat Detail</a>
                          </div>
                        </div>
                      </td>
                    </tr>

                    <!-- MODAL -->
      <div class="modal fade" id="modal-view-<?= $data['id_invoice'];?>">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
             <form method="post" action="">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <?php if($data['status_pay'] == "PAID"){}else{?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-primary">
                                <div class="card-header">

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ubah Status Pembayaran</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" hidden name="id_invoice" value="<?= $data['id_invoice']; ?>">
                                                <select class="form-control" name="status_pembayaran" required>
                                                    <option value="">-PILIH-</option>
                                                    <option value="PAID">SUDAH BAYAR</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="row">
                    <div class="col-md-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    Detail Sales
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama Sales</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-muted"><?= $data['name_sales']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>No. Handphone</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-muted"><?= $data['no_handphone_sales']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-muted"><?= $data['email_sales']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Kode Pos</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-muted"><?= $data['kode_pos_sales']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-muted"><?= $data['alamat_sales']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                    </div>
                    <!-- END COL 6 -->
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                Detail Pelanggan
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nama Pelanggan</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-muted"><?= $data['name_customer']; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nama Toko</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-muted"><?= $data['name_toko']; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>No. Handphone</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-muted"><?= $data['no_handphone_customer']; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-muted"><?= $data['email_customer']; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nomor Toko</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-muted"><?= $data['nomor_toko']; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-muted"><?= $data['kode_pos_customer']; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Alamat Toko</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-muted"><?= $data['alamat_toko']; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    </div>
                <!-- END ROW -->
                    <div class="row">
                    <div class="col-md-12">
                        <div class="card card-warning">
                        <div class="card-header">
                            Detail Barang Penjualan                  
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Nama Barang</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label class="text-muted"><?= $data['name_item']; ?></label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Status Bayar</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php if($data['status_pay'] == "UNPAID"){?>
                                        <label class="text-muted"><span class="badge badge-danger">BELUM BAYAR</span></label>
                                        <?php } else { ?>
                                        <label class="text-muted"><span class="badge badge-primary">SUDAH BAYAR</span></label>    
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Ukuran</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label class="text-muted"><?= $data['size']; ?></label>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Jenis Ukuran</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label class="text-muted"><?= $data['size_type']; ?></label>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Jenis Satuan</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label class="text-muted"><?= $data['unit_type']; ?></label>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Harga Jual</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label class="text-muted"><?= $data['selling_price']; ?></label>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Jumlah Jual</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label class="text-muted"><?= $data['selling_amount']; ?></label>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-12">
                                <hr>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Total Harga</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label class="text-muted"><?= $data['total_amount']; ?></label>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <?php if($data['status_pay'] == "PAID"){}else{ ?>
                    <button type="submit" class="btn btn-success" name="update">Update Pembayaran</button>
                    <?php } ?>
                    <a href="cetak/invoice.php?inv=<?= $data['id_invoice']; ?>" target="blank" class="btn btn-primary">Cetak Invoice</a>
                </div>
             </form>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
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