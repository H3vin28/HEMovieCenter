<body class="control-sidebar-slide-open layout-footer-fixed layout-navbar-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo base_url('assets/favicon_io/to_logo.png')?>" alt="VLQBT" height="100" width="100">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url('assets/favicon_io/to_logo.png')?>" alt="VLQBT Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">TOMWASA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('assets/')?>pro_pic_images/pro_pic_icon.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo strtoupper($hresult->username);?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo base_url('eo/home/')?>" class="nav-link <?php echo $this->uri->segment(2) == 'home' ? 'active' : '';?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboards</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('eo/consumers/')?>" class="nav-link <?php echo $this->uri->segment(2) == 'consumers' ? 'active' : '';?>">
              <i class="nav-icon fas fa-users"></i>
              <p>Consumers</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('eo/meter_reading/')?>" class="nav-link <?php echo $this->uri->segment(2) == 'meter_reading' ? 'active' : '';?>">
              <i class="nav-icon fas fa-solid fa-chalkboard-user"></i>
              <p>Meter Reading</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('eo/individual_ledger/')?>" class="nav-link <?php echo $this->uri->segment(2) == 'individual_ledger' ? 'active' : '';?>">
              <i class="nav-icon fas fa-address-book fa-fw"></i>
              <p>Individual Ledger</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('eo/monthly_billing/')?>" class="nav-link <?php echo $this->uri->segment(2) == 'monthly_billing' ? 'active' : '';?>">
              <i class="nav-icon fas fa-solid fa-calendar-days"></i>
              <p>Monthly Billing</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('eo/logout/')?>" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>