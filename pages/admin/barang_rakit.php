    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');
        include('../../model/ItemsModel.php');
        include('../../model/SalesModel.php');
        $model = new ItemsModel;
        $model_sales = new SalesModel;
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
  include('../../controller/RaftsController.php');
  $alert = "";

  $controller = new RaftsController;

  if(isset($_POST['save'])){
    
    $quantity = $_POST['quantity'];
    for($i = 0; $i < count($quantity); $i++){

        $username = $_SESSION['username'];

        $name_item = $_POST['name_item'][$i];
        $name_sales = $_POST['name_sales'];
        $size = $_POST['size'][$i];
        $size_type = $_POST['size_type'][$i];
        $unit_type = $_POST['unit_type'][$i];
        $quantitys = $_POST['quantity'][$i];

        if($quantitys !== "" && $name_sales !== ""){
            $alert = $controller->AddController($username, $name_item, $name_sales, $size, $size_type, $quantitys, $unit_type);
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
            <h1 class="m-0">Tambah Barang Rakit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Barang Rakit</a></li>
              <li class="breadcrumb-item active">Tambah Barang Rakit</li>
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
        <form method="post" action="">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="card-body">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label>Nama Sales <span style="color: red;">*</span></label>
                              <select class="form-control select2" name="name_sales" required>
                                <option value="">-PILIH-</option>
                                <?php foreach($model_sales->View() as $mdl){ ?>
                                  <option value="<?= $mdl['name_sales']; ?>"><?= $mdl['name_sales'];?></option>
                                <?php } ?>
                              </select>
                          </div>
                        </div>
                    </div>
                  </div>
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama Barang</th>
                      <th>Nomor Ukuran</th>
                      <th>Jenis Ukuran</th>
                      <th>Jenis Satuan</th>
                      <th>Jumlah Stok Saat ini</th>
                      <th>Jumlah Rusak</th>
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
                          <input type="text" hidden name="name_item[]" value="<?= $data['name_item']; ?>">
                          <input type="text" hidden name="size[]" value="<?= $data['size']; ?>">
                          <input type="text" hidden name="size_type[]" value="<?= $data['size_type']; ?>">
                          <input type="text" hidden name="unit_type[]" value="<?=  $data['unit_type']; ?>">
                        </td>
                      <td><?= $data['name_item']; ?></td>
                      <td><?= $data['size']; ?></td>
                      <td><?= $data['size_type']; ?></td>
                      <td><?=  $data['unit_type']; ?></td>
                      <td><?= $data['quantity']; ?></td>
                      <?php if($data['quantity'] == 0){?>
                      <td><input type="text" name="quantity[]" readonly class="form-control"></td>
                      <?php }else{?>
                      <td><input type="text" name="quantity[]" class="form-control"></td>
                      <?php } ?>
                    </tr>
                    <?php 
                     } ?>
                  </tbody>
                </table>
                <button type="submit" name="save" class="btn btn-block btn-primary mt-4">Simpan</button>
              </div>
            </div>
          </div>   
        </div>     
        </form> 
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