    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');

        include('../../model/ReturModel.php');
        
        $model = new ReturModel;
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
  include('../../controller/ReturController.php');
  $alert = "";

  $controller = new ReturController;


  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Retur </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Retur</a></li>
              <li class="breadcrumb-item active">Data Retur</li>
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
                      <th>Tanggal Retur</th>
                      <th>Nama Barang</th>
                      <th>Nama Sales</th>
                      <th>Nama Pelanggan</th>
                      <th>Jumlah Retur</th>
                      <th>Total Retur</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach($model->View() as $data){
                    ?>
                    <tr>
                      <td><?= substr($data['name_sales'], 0, 2); ?><?= $data['no_invoice']; ?></td>
                      <td><?= $data['retur_date']; ?></td>
                      <td><?= $data['name_item']; ?></td>
                      <td><?= $data['name_sales']; ?></td>
                      <td><?= $data['name_customer']; ?></td>
                      <td><?= $data['retur_amount']; ?></td>
                      <td><?= $data['total_potongan']; ?></td>
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