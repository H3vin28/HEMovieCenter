<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/images/HEMC1.png')?>" alt="AdminLTE Logo" class="" style="width: 96%;">
        </div>
      </div>

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/images/pro_pic.png')?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block" <?= @$row != null ? '':'data-toggle="modal" data-target="#login-modal"'?> ><?= @$row != null ? $row->fullname: 'Login'?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?= base_url('admin/')?>" class="nav-link <?= $this->uri->segment(2) == null ? 'active':'';?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/users/')?>" class="nav-link <?= $this->uri->segment(2) == 'users' ? 'active':'';?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/movies/')?>" class="nav-link <?= $this->uri->segment(2) == 'movies' ? 'active':'';?>">
              <i class="nav-icon fas fa-film"></i>
              <p>
                Movies
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('main/logout/')?>" class="nav-link">
              <i class="nav-icon fa fa-power-off"></i>
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