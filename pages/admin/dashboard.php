    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');

        include('../../model/ItemsModel.php');
        
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
  include('../../controller/SaleController.php');
  $alert = "";

  $hari_ini = date("Y-m-d");
  $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
  $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));

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
            <div class="card card-warning">
                <div class="card-header">
                  Data Barang
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama Barang</th>
                      <th>Nomor Ukuran</th>
                      <th>Jenis Ukuran</th>
                      <th>Stock Barang</th>
                      <th>Jenis Satuan</th>
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
                      <td><?= $data['name_item']; ?></td>
                      <td><?= $data['size']; ?></td>
                      <td><?= $data['size_type']; ?></td>
                      <td><?= $data['quantity']; ?></td>
                      <td><?=  $data['unit_type']; ?></td>
                      <td>
                        <div class="btn-group">
                          <?php if($data['quantity'] == 0){ ?>
                            <button type="button" class="btn btn-danger" disabled>Action</button>
                            <button type="button" class="btn btn-danger dropdown-toggle" disabled data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item" href="input_detail_penjualan.php?item=<?= $data['id_item']; ?>">Jual</a>
                          </div>
                          <?php } else{ ?>
                            <button type="button" class="btn btn-success">Action</button>
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item" href="input_detail_penjualan.php?item=<?= $data['id_item']; ?>">Jual</a>
                          </div>
                          <?php } ?>
                        </div>
                      </td>
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