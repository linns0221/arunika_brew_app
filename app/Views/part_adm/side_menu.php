<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- Brand Logo -->
  <a href="dashboard" class="brand-link">
    <img src="/file_gambar/logo3.png" alt="Arunika Brew Logo"
         class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Arunika Brew</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-3">
      <ul class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview" role="menu" data-accordion="false">

        <!-- Dashboard -->
        <li class="nav-item">
          <a href="dashboard" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Orders -->
        <li class="nav-item">
          <a href="transaksi" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>Orders</p>
          </a>
        </li>

        <?php if (session()->get('hak_akses') == 'admin') { ?>

        <!-- Category -->
        <li class="nav-item">
          <a href="kategori" class="nav-link">
            <i class="nav-icon fas fa-tags"></i>
            <p>Category</p>
          </a>
        </li>

        <!-- Menu -->
        <li class="nav-item">
          <a href="<?= base_url('/barang'); ?>" class="nav-link">
            <i class="nav-icon fas fa-coffee"></i>
            <p>Menu</p>
          </a>
        </li>

        <?php } ?>

        <!-- Divider -->
        <li class="nav-header">SYSTEM</li>

        <!-- Logout -->
        <li class="nav-item">
          <a href="logout" class="nav-link text-danger">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Log Out</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->

  </div>
  <!-- /.sidebar -->
</aside>