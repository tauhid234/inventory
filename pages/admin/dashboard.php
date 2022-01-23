    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');

        include('../../model/ItemsModel.php');
        include('../../model/CartSaleModel.php');
        include('../../model/CustomerModel.php');
        include('../../model/SalesModel.php');
        
        $model = new ItemsModel();
        $model_cart = new CartSaleModel;
        $model_customer = new CustomerModel;
        $model_sales = new SalesModel;
        
        $username = $_SESSION['username'];
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
  
  include('../../controller/SaleController.php');
  include('../../controller/CartSaleController.php');
  include('../../controller/InvoiceController.php');

  $controller = new SaleController;
  $controller_cart_sale = new CartSaleController;
  $controller_invoice = new InvoiceController;
  $alert = "";

  $hari_ini = date("Y-m-d");
  $tgl_now = gmdate('Y-m-d');
  $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
  $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));


  if(isset($_POST['cart'])){

    $username = $_SESSION['username'];
    $id_item_cart = $_POST['id_item_cart'];

    $alert = $controller_cart_sale->AddController($id_item_cart, $username);
  }

  if(isset($_POST['remove'])){
    $id = $_POST['remove_item'];
    $alert = $controller_cart_sale->DeleteController($id);
  }


  if(isset($_POST['submit'])){
    // var_dump($_POST['harga_sales']);
    
    

    $harga_s = $_POST['harga_sales'];
    // $count_item = $model->Count();
    
    
    for($i = 0; $i < count($harga_s); $i++){

      $username = $_SESSION['username'];

      $id_item = $_POST['id_item'][$i];
      $selling_price_sales = $_POST['harga_sales'][$i];
      $selling_price_admin = $_POST['harga_admin'][$i];
      $selling_amount = $_POST['jumlah_jual'][$i];
      $total_amount = $_POST['total_seluruh'][$i];

      $stock = $_POST['stock'][$i];
      $value = (int)$stock - (int)$selling_amount;
      $price_clean = (int)$selling_price_sales - (int)$selling_price_admin;

      $id_cus = $_POST['id_customer'];
      $id_sales = $_POST['id_sales'];
      $sale_versi = $_POST['versi'][$i];

      if($selling_price_sales !== ""){
        // echo "NM ".$type.'<br/> sales '.$id_sales.'<br/> id item '.$item_id;
        // echo "VALUE ".$value;
        $controller_invoice->AddInvoiceControllerV2($username, $id_cus, $id_sales, $sale_versi);
        $alert = $controller->AddPenjualanControllerV2($id_item, $value, $id_cus, $id_sales, $selling_amount, $selling_price_sales, $selling_price_admin, $sale_versi, $total_amount, $price_clean, $username);

      }
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
            <h1 class="m-0">Dashboard <?= $_SESSION['peran']; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
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
              <div class="card-header">Tambahkan Item</div>
              <div class="card-body">
                <form method="post" action="">
                  <div class="row">
                      <div class="col-sm-8">
                        <div class="form-group">
                            <label>Nama Barang <span style="color: red;">*</span></label>
                            <select class="form-control select2" name="id_item_cart" required>
                              <option value="">-PILIH-</option>
                              <?php foreach($model->ViewItemSale() as $mdl){ ?>
                                <option value="<?= $mdl['id_item']; ?>"><?= $mdl['name_item'];?></option>
                              <?php } ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <button type="submit" name="cart" class="btn btn-block btn-primary" style="margin-top: 30px;">Tambahkan Item +</button>
                        </div>
                      </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header">
                  Simpan Penjualan
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post" action="">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Pelanggan <span style="color: red;">*</span></label>
                            <select class="form-control select2" name="id_customer" id="id_customer">
                              <option value="">-PILIH-</option>
                              <?php foreach($model_customer->View() as $mdl){ ?>
                                <option value="<?= $mdl['id_customer']; ?>"><?= $mdl['name_customer'];?></option>
                              <?php } ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Tanggal Penjualan</label>
                          <input type="date" readonly class="form-control" name="tanggal_penjualan" value="<?= $hari_ini; ?>">
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                            <label>Nama Sales <span style="color: red;">*</span></label>
                            <select class="form-control select2" name="id_sales" id="id_sales">
                              <option value="">-PILIH-</option>
                              <?php foreach($model_sales->View() as $mdl){ ?>
                                <option value="<?= $mdl['id_sales']; ?>"><?= $mdl['name_sales'];?></option>
                              <?php } ?>
                            </select>
                        </div>
                      </div>
                  </div>
                </div>
                <table class="table table-bordered table-striped" id="menu_penjualan">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama Barang</th>
                      <th>Nomor Ukuran</th>
                      <th>Jenis Ukuran</th>
                      <th>Stock Barang</th>
                      <th>Jenis Satuan</th>
                      <th>Harga Jual Admin</th>
                      <th>Harga Jual Sales</th>
                      <th>Jumlah Jual</th>
                      <th>Total Harga</th>
                      <th>Action</th>
                      <!-- <th>Tindakan</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach($model_cart->ViewCartSale($username) as $data){
                    ?>
                    <tr>
                      <td>
                        <?= $no++; ?>
                        <input type="text" hidden class="form-control" readonly name="id_item[]" value="<?= $data['id_cart']; ?>">
                        <input type="text" hidden class="form-control" readonly name="versi[]" value="<?= time(); ?>">
                      </td>
                      <td><?= $data['name_cart']; ?></td>
                      <td><?= $data['size_cart']; ?></td>
                      <td><?= $data['size_type_cart']; ?></td>
                      <td><input type="number" class="form-control" readonly name="stock[]" id="stock_<?= $data['id']; ?>" value="<?= $data['quantity_cart']; ?>"></td>
                      <td><?=  $data['unit_type_cart']; ?></td>
                      <td><?= $data['selling_price_cart']; ?></td>
                      <td>
                        <input type="number" hidden class="form-control" name="harga_admin[]" id="harga_admin_<?= $data['id']; ?>" value="<?= $data['selling_price_cart']; ?>">
                        <?php if($data['quantity_cart'] == 0){ ?>
                        <input type="number" readonly class="form-control" name="harga_sales[]" id="harga_sales_<?= $data['id']; ?>">
                        <?php }else{ ?>
                        <input type="number" class="form-control" name="harga_sales[]" id="harga_sales_<?= $data['id']; ?>">
                        <?php } ?>
                      </td>
                      <td>
                        <?php if($data['quantity_cart'] == 0){ ?>
                        <input type="number" readonly class="form-control" name="jumlah_jual[]" id="jumlah_jual_<?= $data['id']; ?>" onkeyup="sum(<?= $data['id']; ?>)"></td>
                        <?php }else{ ?>
                        <input type="number" class="form-control" name="jumlah_jual[]" id="jumlah_jual_<?= $data['id']; ?>" onclick="sum(<?= $data['id']; ?>)" onkeyup="sum(<?= $data['id']; ?>)"></td>
                        <?php } ?>
                      <td><input type="number" class="form-control" readonly name="total_seluruh[]" id="total_seluruh_<?= $data['id']; ?>" ></td>
                      <td>
                        <input type="text" hidden name="remove_item" value="<?= $data['id_cart']; ?>">
                        <button type="submit" name="remove" class="btn btn-block btn-danger mt-4">Hapus</button>
                      </td>
                    </tr>
                    <?php 
                     } ?>
                  </tbody>
                </table>
                <button type="submit" name="submit" class="btn btn-block btn-primary mt-4">Jual</button>
                </form>
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