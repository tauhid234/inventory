<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link" style="background-color: white;">
      <img src="../../dist/img/LOGO BINTANG 89.png" alt="INVENTORY Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" style="color: #2980b9;"><b>BINTANG 89</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">ANONYMOUS</a>
        </div>
      </div> -->

      <!-- SidebarSearch Form -->
      <div class="form-inline mt-4">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Cari Menu" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="../../pages/admin/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-light fa-cart-arrow-down"></i>
              <p>
                Penjualan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../pages/admin/penjualan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan Baru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/penjualan_view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Penjualan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-light fa-bag-shopping"></i>
              <p>
                Pembelian
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../pages/admin/pembelian_v2" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembelian Baru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/pembelian_view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pembelian</p>
                </a>
              </li>
            </ul>
          </li>
          <?php if($peran != 'ADMIN'){?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-regular fa-hand-holding-dollar"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../pages/admin/total_penjualan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Total Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/total_pembelian" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Total Pembelian</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-light fa-file-invoice"></i>
              <p>
                Invoice
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../pages/admin/invoice_view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Invoice Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/invoice_retur_view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Invoice Retur</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-light fa-arrow-right-arrow-left"></i>
              <p>
                Retur
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../pages/admin/retur_view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Retur</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="../../pages/admin/potongan_view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Potongan</p>
                </a>
              </li> -->
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-regular fa-credit-card"></i>
              <p>
                Hutang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../pages/admin/hutang_pelanggan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hutang Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/hutang_suplier" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hutang Suplier</p>
                </a>
              </li>
            </ul>
          </li>
          <?php if($peran != 'ADMIN'){?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-light fa-id-card-clip"></i>
              <p>
                Suplier
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../pages/admin/suplier" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Suplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/suplier_view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Suplier</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

          <?php if($peran != 'ADMIN'){?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-light fa-user-ninja"></i>
              <p>
                Sales
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../pages/admin/sales" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/sales_view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Sales</p>
                </a>
              </li>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/pelanggan_sales" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelanggan Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/profit_view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Profit</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

          <?php if($peran != 'ADMIN'){?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-light fa-users-gear"></i>
              <p>
                Pelanggan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../pages/admin/customer" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/customer_view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pelanggan</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

          <?php if($peran != 'ADMIN'){?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-solid fa-user-shield"></i>
              <p>
                Pengguna
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../pages/admin/user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Pengguna</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/user_view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pengguna</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-light fa-boxes-stacked"></i>
              <p>
                Barang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if($peran != 'ADMIN'){?>
              <li class="nav-item">
                <a href="../../pages/admin/barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Barang</p>
                </a>
              </li>
              <?php } ?>
              <li class="nav-item">
                <a href="../../pages/admin/barang_view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Barang</p>
                </a>
              </li>
            </ul>
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../pages/admin/kategori.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/kategori_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kategori</p>
                </a>
              </li>
            </ul> -->
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-light fa-truck-ramp-box"></i>
              <p>
                Barang Rakit
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../pages/admin/barang_rakit" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Barang Rakit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/barang_rakit_view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Barang Rakit</p>
                </a>
              </li>
            </ul>
          </li>

          <?php if($peran != 'ADMIN'){?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-light fa-paste"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../pages/admin/laporan_penjualan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/laporan_pembelian" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Pembelian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/report_profit_sales" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Profit Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/report_potongan_sales" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Potongan Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/laporan_retur" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Data Retur</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/laporan_barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/laporan_barang_rakit" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Data Barang Rakit</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a href="../../pages/logout" class="nav-link">
              <i class="nav-icon fas fa-solid fa-arrow-right-from-bracket"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>