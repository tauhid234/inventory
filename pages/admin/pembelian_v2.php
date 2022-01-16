      <!-- HEADER -->
      <?php
        include('../../component_temp/header.php');

        include('../../model/SuplierModel.php');
        include('../../model/ItemsModel.php');

        $model_suplier = new SuplierModel;
        $model = new ItemsModel();
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

  $hari_ini = date("Y-m-d");


  if(isset($_POST['submit'])){

      $no_invoice = $_POST['no_invoice'];
      
      for($i = 0; $i < count($no_invoice); $i++){
        
        $id_suplier = $_POST['id_suplier'];
        $tgl_beli = $_POST['tanggal_pembelian'];
        $status_bayar = $_POST['status_bayar'];
        
        $no_invoicee = $_POST['no_invoice'][$i];

        $id_items = $_POST['id_item'][$i];
        $nama_barang = $_POST['name_item'][$i];
        $ukuran = $_POST['size'][$i];
        $jenis_ukuran = $_POST['size_type'][$i];
        $jenis_satuan = $_POST['unit_type'][$i];
        $harga_beli = $_POST['harga_beli'][$i];
        $harga_jual = $_POST['harga_jual'][$i];
        $jumlah_beli = $_POST['jumlah_beli'][$i];
        $total_harga = $_POST['total_transaksi_pembelian'][$i];

        $username = $_SESSION['username'];
      
        if($no_invoicee !== ""){
            $alert = $controller->AddController($id_suplier, $no_invoicee, $tgl_beli, $status_bayar, $id_items, $nama_barang, $ukuran, $jenis_ukuran, $jenis_satuan, $harga_beli, $harga_jual, $jumlah_beli, $total_harga, $username);
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
            <h1 class="m-0">Pembelian Baru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Pembelian</li>
              <li class="breadcrumb-item active">Pembelian Baru</li>
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
                <form method="post" action="">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Suplier <span style="color: red;">*</span></label>
                            <select class="form-control select2" name="id_suplier" required>
                                <option value="">-PILIH-</option>
                                <?php foreach($model_suplier->View() as $mdl){ ?>
                                <option value="<?= $mdl['id_suplier']; ?>"><?= $mdl['name_suplier'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tanggal Pembelian <span style="color: red;">*</span></label>
                            <input type="date" required class="form-control" name="tanggal_pembelian">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">
                            <label>Status Bayar <span style="color: red;">*</span></label>
                            <select class="form-control" name="status_bayar" required>
                                <option value="">-PILIH-</option>
                                <option value="PAID">BAYAR</option>
                                <option value="UNPAID">BELUM BAYAR</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group"></div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>No Invoice</th>
                        <th>Nama Barang</th>
                        <th>Ukuran</th>
                        <th>Jenis Ukuran</th>
                        <th>Jenis Satuan</th>
                        <th>Harga Pembelian</th>
                        <th>Harga Jual</th>
                        <th>Jumlah Beli</th>
                        <th>Total Harga</th>
                      <!-- <th>Tindakan</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach($model->View() as $data){
                    ?>
                    <tr>
                      <td>
                        <?= $no++; ?>
                        <input type="text" hidden class="form-control" readonly name="id_item[]" value="<?= $data['id_item']; ?>">
                        <input type="text" hidden class="form-control" readonly name="versi[]" value="<?= time(); ?>">
                      </td>
                      <td><input type="text" class="form-control" name="no_invoice[]"></td>
                      <td><?= $data['name_item']; ?><input type="text" hidden readonly class="form-control" name="name_item[]" value="<?= $data['name_item']; ?>"></td>
                      <td><?= $data['size']; ?><input type="text" hidden readonly class="form-control" name="size[]" value="<?= $data['size']; ?>"></td>
                      <td><?= $data['size_type']; ?><input type="text" hidden readonly class="form-control" name="size_type[]" value="<?= $data['size_type']; ?>"></td>
                      <td><?= $data['unit_type']; ?><input type="text" hidden readonly class="form-control" name="unit_type[]" value="<?= $data['unit_type']; ?>"></td>
                      <td><input type="number" class="form-control" name="harga_beli[]" id="harga_beli_<?= $data['id']; ?>" value="<?= $data['purchase_price']; ?>" onclick="sumV2(<?= $data['id']; ?>)" onkeyup="sumV2(<?= $data['id']; ?>)"></td>
                      <td><input type="number" class="form-control" name="harga_jual[]" id="harga_jual_<?= $data['id']; ?>" value="<?= $data['selling_price']; ?>"></td>
                      <td><input type="number" class="form-control" name="jumlah_beli[]" id="jumlah_beli_<?= $data['id']; ?>" onclick="sumV2(<?= $data['id']; ?>)" onkeyup="sumV2(<?= $data['id']; ?>)"></td>
                      <td><input type="number" readonly class="form-control" name="total_transaksi_pembelian[]" id="total_transaksi_pembelian_<?= $data['id']; ?>"></td>
                    </tr>
                    <?php 
                     } ?>
                  </tbody>
                </table>
                <button type="submit" name="submit" class="btn btn-block btn-primary mt-4">Beli</button>
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