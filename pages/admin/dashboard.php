    <!-- HEADER -->
    <?php
        include('../../component_temp/header.php');
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
            <h1 class="m-0">Dashboard <?= $_SESSION['peran']; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <!-- <h3><sup style="font-size: 20px"></sup></h3> -->

                <p>Barang Masuk</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- END COL -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <!-- <h3><sup style="font-size: 20px"></sup></h3> -->

                <p>Barang Keluar</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- <div class="col-lg-3 col-6">
            small box
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6"> -->
            <!-- small box -->
            <!-- <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-6">
            <div class="card" style="height: 400px;">
                <div class="card-header">
                  <h3 class="card-title">ITEM HARI INI YANG BARU DITAMBAHKAN</h3>
                </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama Barang</th>
                      <th>Harga Jual Barang</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Apple</td>
                      <td>Rp 12.000.000</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>IPhone 11</td>
                      <td>Rp 22.000.000</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Redmi Pro 7 Mobile</td>
                      <td>Rp 10.000.000</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card" style="height: 400px;">
                  <div class="card-header">
                    <h3 class="card-title">PERINGATAN STOK</h3>
                  </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama Kategori</th>
                        <th>Nama Barang</th>
                        <th>Persediaan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Acer</td>
                        <td>Laptop Acer</td>
                        <td>12</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>ROG</td>
                        <td>Laptop ASUS ROG</td>
                        <td>5</td>
                      </tr>
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

