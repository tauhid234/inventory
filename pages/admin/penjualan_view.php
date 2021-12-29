    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');
        include('../../model/SaleModel.php');
        $model = new SaleModel();
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
            <h1 class="m-0">Data Penjualan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Penjualan</a></li>
              <li class="breadcrumb-item active">Data Penjualan</li>
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
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Tanggal Penjualan</th>
                      <th>Nama Barang</th>
                      <th>Nama Sales</th>
                      <th>Nama Pelanggan</th>
                      <th>Kuantitas</th>
                      <th>Harga Penjualan</th>
                      <th>Total Penjualan</th>
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
                      <td><?= $data['sell_date']; ?></td>
                      <td><?= $data['name_item']; ?></td>
                      <td><?= $data['name_sales']; ?></td>
                      <td><?= $data['name_customer']; ?></td>
                      <td><?= $data['selling_amount']; ?></td>
                      <td><?= $data['price_sales']; ?></td>
                      <td><?= $data['total_amount']; ?></td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-success">Action</button>
                          <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="?modal=<?= $data['id']; ?>" data-toggle="modal" data-target="#modal-view-<?= $data['id']; ?>">Lihat Detail</a>
                            <?php if($data['no_invoice_sale'] == ""){ ?>
                            <a class="dropdown-item" href="input_detail_invoice.php?item=<?= $data['id_selling_items']; ?>">Input Invoice</a>
                            <?php }else{} ?>
                        </div>
                      </td>
                    </tr>
                    <!-- MODAL -->
                    <div class="modal fade" id="modal-view-<?= $data['id'];?>">

                      <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Detail Penjualan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
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
                                            <label class="text-muted"><?= $data['price_sales']; ?></label>
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
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
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