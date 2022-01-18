    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');

        include('../../model/InvoiceModel.php');
        include('../../model/SaleModel.php');
        include('../../model/CustomerModel.php');
        include('../../model/SalesModel.php');
        
        $model = new InvoiceModel();
        $model_sale = new SaleModel;
        $model_sales = new SalesModel;
        $model_customer = new CustomerModel;
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
  include('../../controller/ReturController.php');
  $alert = "";

  $controller = new InvoiceController();
  $retur_controller = new ReturController;

  $disable = "";

  if(isset($_GET['retur']) && isset($_GET['v'])){

      $no_invoice = $_GET['retur'];
      $versi = $_GET['v'];
      $data_invoice = $model->ViewNoInvoice($no_invoice, $versi);
      $sale = $model_sale->ViewSaleInvoice($no_invoice, $versi);

      $data_sales = $model_sales->ViewId($data_invoice[0]['id_sales_invoice']);
      $data_customer = $model_customer->ViewId($data_invoice[0]['id_customer_invoice']);
  }

  if(isset($_POST['save'])){
      
      
      $saleid = $_POST['id_sale'];
      
      for($i = 0; $i < count($saleid); $i++){
          
          
          $id_sale = $_POST['id_sale'][$i];
          $id_customer = $_POST['id_customer'][$i];
          $id_sales = $_POST['id_sales'][$i];
          $versi_sale = $_POST['sale_versi'][$i];
          $total_potongan = $_POST['total_potongan'][$i];
          $retur_amount = $_POST['jumlah_retur'][$i];
          $no_invoice = $_POST['no_invoice_sale'][$i];
          
          $username = $_SESSION['username'];

        if($total_potongan !== ""){
            $alert = $retur_controller->AddController($id_sale, $id_sales, $id_customer, $retur_amount, $username, $versi_sale, $no_invoice, $total_potongan);
        }
      
      }

    //   $versi = $_POST['versi_get'];
    //   $data_invoice = $model->ViewNoInvoice($no_invoice, $versi);
    //   $sale = $model_sale->ViewSaleInvoice($no_invoice, $versi);

    //   $data_sales = $model_sales->ViewId($data_invoice[0]['id_sales_invoice']);
    //   $data_customer = $model_customer->ViewId($data_invoice[0]['id_customer_invoice']);




  }


  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Retur Barang </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Retur</a></li>
              <li class="breadcrumb-item active">Retur Barang</li>
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
            <div class="card card-info">
                <div class="card-header">
                  Detail Data Invoice
                </div>
              <!-- /.card-header -->
              <div class="card-body">

                    <!-- MODAL -->
             <form method="post" action="">
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
                                                <label class="text-muted"><?= $data_sales[0]['name_sales']; ?></label>
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
                                                <label class="text-muted"><?= $data_sales[0]['no_handphone_sales']; ?></label>
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
                                                <label class="text-muted"><?= $data_sales[0]['email_sales']; ?></label>
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
                                                <label class="text-muted"><?= $data_sales[0]['kode_pos_sales']; ?></label>
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
                                                <label class="text-muted"><?= $data_sales[0]['alamat_sales']; ?></label>
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
                                            <label class="text-muted"><?= $data_customer[0]['name_customer']; ?></label>
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
                                            <label class="text-muted"><?= $data_customer[0]['name_toko']; ?></label>
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
                                            <label class="text-muted"><?= $data_customer[0]['no_handphone_customer']; ?></label>
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
                                            <label class="text-muted"><?= $data_customer[0]['email_customer']; ?></label>
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
                                            <label class="text-muted"><?= $data_customer[0]['nomor_toko']; ?></label>
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
                                            <label class="text-muted"><?= $data_customer[0]['kode_pos_customer']; ?></label>
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
                                            <label class="text-muted"><?= $data_customer[0]['alamat_toko']; ?></label>
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
                                        <div class="col-md-12">
                                            <table class="table table-striped bordered" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Tanggal Penjualan</th>
                                                        <th>Nama Barang</th>
                                                        <th>Nama Sales</th>
                                                        <th>Nama Pelanggan</th>
                                                        <th>Jumlah Jual</th>
                                                        <th>Harga Penjualan</th>
                                                        <th>Total Penjualan</th>
                                                        <th>Jumlah Retur</th>
                                                        <th>Total Potongan Penjualan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; foreach($sale as $s) { ?>
                                                    <tr>
                                                        <td>
                                                            <?= $i++; ?>
                                                            <input type="text" name="id_sale[]" hidden value="<?= $s['id_selling_items']; ?>">
                                                            <input type="text" name="id_sales[]" hidden value="<?= $s['id_sales']; ?>">
                                                            <input type="text" name="id_customer[]" hidden value="<?= $s['id_customer']; ?>">
                                                            <input type="text" name="no_invoice_sale[]" hidden value="<?= $s['no_invoice_sale']; ?>">
                                                            <input type="text" name="sale_versi[]" hidden value="<?= $s['sale_versi']; ?>">
                                                        </td>
                                                        <td><?= $s['sell_date']; ?></td>
                                                        <td><?= $s['name_item']; ?></td>
                                                        <td><?= $s['name_sales']; ?></td>
                                                        <td><?= $s['name_customer']; ?></td>
                                                        <td><input type="text" class="form-control" name="jumlah_jual[]" id="jumlah_jual_<?= $s['id']; ?>" readonly value="<?= $s['selling_amount']; ?>"></td>
                                                        <td><?= $s['price_sales']; ?> <input type="text" hidden name="harga_jual[]" id="harga_jual_<?= $s['id'];?>" hidden value="<?= $s['price_sales']; ?>"></td>
                                                        <td><input type="text" class="form-control" readonly name="total_amount[]" id="total_amount_<?= $s['id']; ?>" value="<?= $s['total_amount']; ?>"></td>
                                                        <?php if($s['selling_amount'] == 0){ ?>
                                                        <td><input type="text" class="form-control" readonly name="jumlah_retur[]" id="jumlah_retur_<?= $s['id']; ?>" onkeyup="sumRetur(<?= $s['id']; ?>)"></td>
                                                        <?php }else{ ?>
                                                        <td>
                                                            <input type="number" class="form-control" name="jumlah_retur[]" id="jumlah_retur_<?= $s['id']; ?>" onclick="sumRetur(<?= $s['id']; ?>)" onkeyup="sumRetur(<?= $s['id']; ?>)">                                                            
                                                        </td>
                                                        <td><input type="text" readonly class="form-control" name="total_potongan[]" id="total_potongan_<?= $s['id']; ?>"></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" name="save" class="btn btn-block btn-primary" <?= $disable; ?>>Simpan Retur</button>                    
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