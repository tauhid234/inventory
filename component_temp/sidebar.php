<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link" style="background-color: white;">
      <img src="../../dist/img/LOGO-BINTANG-89.png" alt="INVENTORY Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" style="color: black;">BINTANG 89</span>
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
            <a href="../../pages/admin/dashboard.php" class="nav-link">
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
                <a href="../../pages/admin/penjualan.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan Baru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/penjualan_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Penjualan</p>
                </a>
              </li>
            </ul>
          </li>
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
                <a href="../../pages/admin/invoice_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Invoice</p>
                </a>
              </li>
            </ul>
          </li>
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
                <a href="../../pages/admin/sales.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/sales_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Sales</p>
                </a>
              </li>
            </ul>
          </li>
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
                <a href="../../pages/admin/customer.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/customer_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pelanggan</p>
                </a>
              </li>
            </ul>
          </li>
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
                <a href="../../pages/admin/user.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Pengguna</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/user_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pengguna</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-light fa-boxes-stacked"></i>
              <p>
                Barang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../pages/admin/barang.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../pages/admin/barang_view.php" class="nav-link">
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
            <a href="../../pages/logout.php" class="nav-link">
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