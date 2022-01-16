    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');
        include('../../model/RaftsModel.php');
        $model = new RaftsModel;
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
            <h1 class="m-0">Laporan Data Barang Rakit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Laporan</a></li>
              <li class="breadcrumb-item active">Laporan Data Barang Rakit</li>
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
                <table class="table table-bordered table-striped" id="laporan_barang_rakit">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama Barang</th>
                      <th>Nomor Ukuran</th>
                      <th>Jenis Ukuran</th>
                      <th>Kuantitas</th>
                      <th>Di Buat</th>
                      <th>Jenis Satuan</th>
                      <th>Status Barang</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach($model->View() as $data){
                    ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $data['name_rafts']; ?></td>
                      <td><?= $data['size_rafts']; ?></td>
                      <td><?= $data['size_type_rafts']; ?></td>
                      <td><?= $data['quantity_rafts']; ?></td>
                      <td><?= $data['create_date']; ?></td>
                      <td><?=  $data['unit_type_rafts']; ?></td>
                      <?php if($data['status_rafts'] == "NOT_REPAIR"){?>
                      <td><span class="badge badge-danger">BELUM DIPERBAIKI</span></td>
                      <?php }else if($data['status_rafts'] == "REPAIR"){?>
                      <td><span class="badge badge-warning">DALAM PERBAIKAN</span></td>
                      <?php }else if($data['status_rafts'] == "DONE_REPAIR"){?>
                      <td><span class="badge badge-success">SUDAH DI PERBAIKI</span></td>
                      <?php } ?>
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