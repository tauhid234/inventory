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
    include('../../controller/PurchaseController.php');
    
    $alert = "";
    $controller = new PurchaseController;

    if(isset($_POST['update'])){
        $id_purchase = $_POST['id_purchase'];
        $status_pay = $_POST['status_bayar'];

        $username = $_SESSION['username'];

        $alert = $controller->UpdatePaymentStatus($id_purchase, $status_pay, $username);
    }
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Pembelian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pembelian</a></li>
              <li class="breadcrumb-item active">Data Pembelian</li>
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
                <div class="card-header">
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="example1">
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
                      <th>Tindakan</th>
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
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-success">Action</button>
                          <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="?modal=<?= $data['id_purchase']; ?>" data-toggle="modal" data-target="#modal-view-<?= $data['id_purchase']; ?>">Lihat Detail</a>
                            <?php if($data['status_pay'] == "UNPAID"){ ?>
                            <a class="dropdown-item" href="modal=<?= $data['id_purchase']; ?>" data-toggle="modal" data-target="#modal-update-<?= $data['id_purchase']; ?>">Update Pembayaran</a>
                            <?php }else{} ?>
                        </div>
                      </td>
                    </tr>
                    <!-- MODAL -->
                    <div class="modal fade" id="modal-view-<?= $data['id_purchase'];?>">

                      <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Detail Pembelian</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                        <div class="card card-secondary">
                                            <div class="card-header">
                                                Detail Suplier
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Nama Suplier</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="text-muted"><?= $data['name_suplier']; ?></label>
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
                                                            <label class="text-muted"><?= $data['no_handphone_suplier']; ?></label>
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
                                                            <label class="text-muted"><?= $data['email_suplier']; ?></label>
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
                                                            <label class="text-muted"><?= $data['kode_pos_suplier']; ?></label>
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
                                                            <label class="text-muted"><?= $data['alamat_suplier']; ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                </div>
                                <!-- END COL 6 -->
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
                                                <label>NO INVOICE</label>
                                              </div>
                                          </div>
                                          <div class="col-sm-3">
                                              <div class="form-group">
                                                <label class="text-muted"><?= $data['no_invoice_purchase']; ?></label>
                                              </div>
                                          </div>
                                          <div class="col-sm-3">
                                            <div class="form-group">
                                            <?php if($data['status_pay'] == "UNPAID"){ ?>
                                                <span class="badge badge-danger">BELUM BAYAR</span>
                                                <?php } else{ ?>
                                                <span class="badge badge-primary">SUDAH BAYAR</span>
                                                <?php } ?>
                                            </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Nama Barang</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label class="text-muted"><?= $data['name_items_purchase']; ?></label>
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
                                            <label class="text-muted"><?= $data['size_purchase']; ?></label>
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
                                            <label>Harga Beli</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label class="text-muted"><?= $data['purchase_price']; ?></label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Jumlah Beli</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label class="text-muted"><?= $data['purchase_amount']; ?></label>
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
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    <!-- MODAL UPDATE -->
                    <div class="modal fade" id="modal-update-<?= $data['id_purchase'];?>">

                      <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Detail Pembelian</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="card card-primary">
                                          <div class="card-header">

                                          </div>
                                          <div class="card-body">
                                            <form method="post" action="">
                                              <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Ubah Status Pembelian</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                        <input type="text" hidden name="id_purchase" value="<?= $data['id_purchase']; ?>">
                                                        <select class="form-control" name="status_bayar" required>
                                                                <option value="">-PILIH-</option>
                                                                <option value="PAID">BAYAR</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" name="update" class="btn btn-primary">UPDATE PEMBAYARAN</button>
                                                    </div>
                                                </div>
                                            </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                        <div class="card card-secondary">
                                            <div class="card-header">
                                                Detail Suplier
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Nama Suplier</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="text-muted"><?= $data['name_suplier']; ?></label>
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
                                                            <label class="text-muted"><?= $data['no_handphone_suplier']; ?></label>
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
                                                            <label class="text-muted"><?= $data['email_suplier']; ?></label>
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
                                                            <label class="text-muted"><?= $data['kode_pos_suplier']; ?></label>
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
                                                            <label class="text-muted"><?= $data['alamat_suplier']; ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                </div>
                                <!-- END COL 6 -->
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
                                                <label>NO INVOICE</label>
                                              </div>
                                          </div>
                                          <div class="col-sm-3">
                                              <div class="form-group">
                                                <label class="text-muted"><?= $data['no_invoice_purchase']; ?></label>
                                              </div>
                                          </div>
                                          <div class="col-sm-3">
                                            <div class="form-group">
                                            <?php if($data['status_pay'] == "UNPAID"){ ?>
                                                <span class="badge badge-danger">BELUM BAYAR</span>
                                                <?php } else{ ?>
                                                <span class="badge badge-primary">SUDAH BAYAR</span>
                                                <?php } ?>
                                            </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Nama Barang</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label class="text-muted"><?= $data['name_items_purchase']; ?></label>
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
                                            <label class="text-muted"><?= $data['size_purchase']; ?></label>
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
                                            <label>Harga Beli</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label class="text-muted"><?= $data['purchase_price']; ?></label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Jumlah Beli</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label class="text-muted"><?= $data['purchase_amount']; ?></label>
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
                            </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
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