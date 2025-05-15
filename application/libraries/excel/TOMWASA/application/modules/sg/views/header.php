<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <span class="navbar-brand">
        <img src="<?php echo base_url('assets/adminlte/')?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8">
        <span class="brand-text font-weight-light">LSystem</span>
      </span>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?php echo base_url('sg/home/')?>" class="nav-link <?php echo $this->uri->segment(2) == 'home' ? 'active' : ''?>">Scan</a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('sg/dqr/')?>" class="nav-link <?php echo $this->uri->segment(2) == 'dqr' ? 'active' : ''?>">QR Code & Profile</a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="order-md-3 navbar-nav ml-auto">
        <li class="nav-item">
          <span class="navbar-brand">
            <img src="<?php echo base_url('assets/pro_pic_images/'.$hresult->image);?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="width: 22%!important;opacity: 0.8">
            <span class="brand-text font-weight-light"><?php echo $hresult->firstname.' '.strtoupper(str_split($hresult->middle_name)[0]).'. '.$hresult->lastname.' '.$hresult->suffix?></span>
          </span>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('sg/logout/')?>">
            <i class="fas fa-power-off"></i>
          </a>
        </li>
      </ul>
      </div>
    </div>
  </nav>
  <!-- /.navbar -->